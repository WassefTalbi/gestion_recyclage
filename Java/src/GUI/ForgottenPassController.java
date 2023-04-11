/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import java.util.Properties;
import java.util.Random;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.TextField;
import Entities.User;
import Services.ServiceUser;
import java.util.Properties;
import java.util.Random;

import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;

import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.TextField;
import javax.mail.Authenticator;
import Entities.User;
import Utils.MyDB;
import java.io.IOException;
import java.net.URL;
import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ResourceBundle;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.input.MouseEvent;
import javafx.stage.Stage;
import javax.swing.JOptionPane;




/**
 *
 * @author houssem
 */
public class ForgottenPassController{
    
    
    private TextField emailOrUsernameField;
    @FXML
    private Button btncon;
    @FXML
    private TextField Email;
       Connection cxn;
       @FXML
    private void update(ActionEvent event)throws IOException {
        
      String verificationCode = generateVerificationCode();
      
        //String bb = generateVerificationCode();
String lien = "http://127.0.0.1:8000 " ;
        String to = Email.getText();
        String from = "kkhedma1@gmail.com";
        String host = "smtp.gmail.com"; // replace with your SMTP server address
        final String username = "kkhedma1@gmail.com";
        final String password = "attrirnlkuijatin";
        final String subject = "Password Reset Verification Code";
        final String content = "Dear User,\n\nPlease use the following verification code to reset your password: %s\n\nYou can reset your password by clicking on the following link: %s\n\nRegards,\nYour Website Team";


        // Set the email properties
        Properties properties = new Properties();
        properties.put("mail.smtp.host", host);
        properties.put("mail.smtp.auth", "true");
        properties.put("mail.smtp.port", "587"); // replace with your SMTP server port number
        properties.put("mail.smtp.starttls.enable", "true");

        // Create a session with the SMTP server
        Session session = Session.getInstance(properties, new Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(username, password);
            }
        });

        try {
             // Create the email message
            MimeMessage message = new MimeMessage(session);
            message.setFrom(new InternetAddress(from));
            message.addRecipient(Message.RecipientType.TO, new InternetAddress(to));
            message.setSubject(subject);
            message.setText(String.format(content,verificationCode,lien));
            ajoutercode(verificationCode,to);



            // Send the email
            Transport.send(message);


            JOptionPane.showMessageDialog(null, "Email sent successfully.");
         
            btncon.getScene().getWindow().hide();
                  Parent root = FXMLLoader.load(getClass().getResource("/GUI/interfacemtp2.fxml"));
                   Stage mainStage = new Stage();
                   Scene scene = new Scene(root);
                   mainStage.setScene(scene);
                   mainStage.show();

        } catch (MessagingException ex) {
            System.err.println("Error sending email: " + ex.getMessage());
        }

    }


public void ajoutercode(String a,String to) {

        try {
        String qry = "INSERT INTO code (codeEmail, email) VALUES ('" + a + "', '" + to + "')";
       cxn = MyDB.getInstance().getCnx();
            Statement stm = cxn.createStatement();
            stm.executeUpdate(qry);
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());

        }

    }
      public static String generateVerificationCode() {
         StringBuilder sb = new StringBuilder();
        int codeLength = 6;
        Random random = new Random();

        for (int i = 0; i < codeLength; i++) {
            sb.append(random.nextInt(10));
        }
        return sb.toString();
    }


    
    
    
    }
     
