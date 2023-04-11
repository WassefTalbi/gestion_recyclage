/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import Services.Serviceclient;
import Services.Servicefreelancer;
import Entities.CurrentUser;
import Entities.Globals;
import Entities.SingleMail;
import Entities.SingleUser;
import Entities.User;
import Entities.client;
import Entities.freelancer;
import static GUI.inscriptionController.doHashing;

import Services.ServiceUser;
import Utils.MyDB;
import com.jfoenix.controls.JFXPasswordField;
import com.jfoenix.controls.JFXTextField;
import java.io.IOException;
import java.net.URL;
import java.sql.ResultSet;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.stage.Stage;
import javafx.stage.StageStyle;
import javax.swing.JOptionPane;

/**
 * FXML Controller class
 *
 * @author donia else{Alert alert =new Alert (Alert.AlertType.ERROR);
 * alert.setHeaderText(null); alert.setContentText("email et mot de passe
 * incorrect"); alert.show();
 *
 *
 * }
 */
public class LoginController implements Initializable {
User ua = new User();
    @FXML
    private JFXPasswordField password;
    @FXML
    private JFXTextField email;
    ServiceUser su = new ServiceUser();
    @FXML
    private ImageView logo;
    Image image;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {

        // TODO
    }

    @FXML
    private void SignUp(ActionEvent event) {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/GUI/inscription.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
        } catch (IOException ex) {
          Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    @FXML
    private void forgottenPass(ActionEvent event) {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/GUI/forgottenPass.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    @FXML
    private void login(ActionEvent event) {

        String pswd = doHashing(password.getText());
        String mail = email.getText();
        freelancer fre = new freelancer();
        Servicefreelancer sf = new Servicefreelancer();
         client cli = new client();
        Serviceclient cl = new Serviceclient();
        if (mail.isEmpty() || pswd.isEmpty()) {
            JOptionPane.showMessageDialog(null, " champs obligatoire !");
            return;
        }
        String role = su.check(mail, pswd);
                ua = su.takout(mail, pswd);

        System.out.println(role);
        if (su.validate(mail, pswd) == false) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("email ou mot de passe incorrect");
            alert.show();
        }
        if (su.validate(mail, pswd) == true) {
            try {
                SingleMail smail = SingleMail.getInstance();
                smail.setMail(mail);
                String sm = smail.getMail() ;
                fre = sf.getUserByEmail(sm) ;
                cli=cl.getUserByEmail(sm);
                SingleUser holder = SingleUser.getInstance();
                holder.setUser(ua);
                Globals.currentUser = new CurrentUser(ua.getNom(), ua.getEmail(), ua.getGUserName());
                //CurrentUser currentUser = new CurrentUser(ua.getNom(),ua.getEmail(),ua.getGUserName());
                //System.out.println(Globals.currentUser);
                Parent root = FXMLLoader.load(getClass().getResource("/GUI/Front" + role + ".fxml"));
                Stage stage = new Stage(StageStyle.DECORATED);
                stage.setTitle("khedma");
                
                stage.setScene(new Scene(root));
                stage.show();

                closeStage();
            } catch (IOException ex) {
                Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
            }

        }
    }

    public void closeStage() {
        ((Stage) password.getScene().getWindow()).close();
    }
}
