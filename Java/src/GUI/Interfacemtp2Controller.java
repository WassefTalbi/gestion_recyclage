/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import Services.ServiceUser;
import Utils.MyDB;
import java.net.URL;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javax.swing.JOptionPane;

/**
 * FXML Controller class
 *
 * @author donia
 */
public class Interfacemtp2Controller implements Initializable {
 @FXML
    private TextField textcode;
    Connection cnx ;
    ResultSet rs ;
    PreparedStatement pst = null ;
      @FXML
    private TextField passwordfiled1;

     
    ServiceUser ps = new  ServiceUser();

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

    @FXML
    private void change(ActionEvent event)throws SQLException {
          String code = textcode.getText();
    if (verife(code)) {
        // Code correct, récupération de l'email associé
        List<String> emails = getEmails();
        String email = getEmailCode(emails, code);
        if (email != null) {
            // Email trouvé, mise à jour des données utilisateur
            updatepassword(email);
            JOptionPane.showMessageDialog(null, "Le mot de passe a été modifié avec succès !");
        } else {
            JOptionPane.showMessageDialog(null, "Aucune adresse e-mail trouvée pour ce code.");
        }
    } else {
        JOptionPane.showMessageDialog(null, "Le code email est incorrect.");
    }
    }
    private List<String> getEmails() throws SQLException {
    List<String> emails = new ArrayList<>();
    String query = "SELECT Email FROM `code` ";
    cnx = MyDB.getInstance().getCnx();
    pst = cnx.prepareStatement(query);
    ResultSet rss = pst.executeQuery();
    while (rss.next()) {
        String email = rss.getString("Email");
        emails.add(email);
    }
    return emails;
}

private String getEmailCode(List<String> emails, String code) {
    String email = null;
    int i = 0;
    while (i < emails.size() && email == null) {
        String query = "SELECT Email FROM `code` WHERE email = ? AND codeEmail = ?";
        try {
            cnx = MyDB.getInstance().getCnx();
            pst = cnx.prepareStatement(query);
            pst.setString(1, emails.get(i));
            pst.setInt(2, Integer.parseInt(code));
            ResultSet rss = pst.executeQuery();
            if (rss.next()) {
                email = rss.getString("email");
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        i++;
    }
    return email;
}
public void updatepassword(String email) {
    try {
        String query = "UPDATE user SET mdp=? WHERE email=?";
        String pa = passwordfiled1.getText();
        cnx = MyDB.getInstance().getCnx();
        pst = cnx.prepareStatement(query);
        pst.setString(1, doHashing(passwordfiled1.getText())); // mettre à jour le champ "password" avec la valeur saisie dans le champ de mot de passe
        pst.setString(2, email); // filtrer les enregistrements à mettre à jour en utilisant l'adresse e-mail
        pst.executeUpdate();
        JOptionPane.showMessageDialog(null, "Le mot de passe a été mis à jour avec succès !");
    } catch (SQLException ex) {
        System.out.println(ex.getMessage());
    }
}
 public static String doHashing(String password) {
        try {
            MessageDigest messageDigest = MessageDigest.getInstance("MD5");

            messageDigest.update(password.getBytes());

            byte[] resultByteArray = messageDigest.digest();

            StringBuilder sb = new StringBuilder();
 
            for (byte b : resultByteArray) {
                sb.append(String.format("%02x", b));
            }

            return sb.toString();

        } catch (NoSuchAlgorithmException e) {
            e.printStackTrace();
        }

        return "";
    }

public boolean verife(String codeEmail) {
    List<String> emails1 = new ArrayList<>();
    int verife = 0;

    String query = "SELECT * FROM `code` ";
    try {
        cnx = MyDB.getInstance().getCnx();
        pst = cnx.prepareStatement(query);
        ResultSet rss = pst.executeQuery();
        while (rss.next()) {
            int x = rss.getInt(1);
            String email = rss.getString("Email");
            emails1.add(email);
            if (x == Integer.parseInt(textcode.getText())) {
                verife++;
            }
        }
        System.out.println(emails1);
        return (verife == 1);
    } catch (SQLException ex) {
        System.out.println(ex.getMessage());
        return false;
    }
}

    
    
    
    
}
