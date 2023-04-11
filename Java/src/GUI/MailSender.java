
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




package GUI;

import Entities.User;
import Entities.freelancer;
import static GUI.inscriptionController.doHashing;
import com.jfoenix.controls.JFXTextField;
import java.io.IOException;
import java.util.Properties;

import javax.activation.DataHandler;
import javax.activation.DataSource;
import javax.activation.FileDataSource;
import javax.mail.Authenticator;
import javax.mail.BodyPart;
import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.Multipart;

import javax.mail.Authenticator;
import javax.mail.Message;

import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;

import javax.mail.internet.MimeBodyPart;
import javax.mail.internet.MimeMessage;
import javax.mail.internet.MimeMultipart;

/**
 *
 * @author medal
=======
import javax.mail.internet.MimeMessage;

/**
 *
 * @author FLAM
>>>>>>> origin/main
 */
public class MailSender {
    public static void sendMail(freelancer freelancer) throws Exception{
        System.out.println("Preparing to send email");
        Properties p = new Properties();
        
        p.put("mail.smtp.auth", "true");
        p.put("mail.smtp.starttls.enable", "true");
        p.put("mail.smtp.host", "smtp.gmail.com");
             p.put("mail.smtp.ssl.trust", "smtp.gmail.com");
        p.put("mail.smtp.port", "587");
        
        String myAccountEmail = "kkhedma1@gmail.com";
        String password = "attrirnlkuijatin";
        
        Session session = Session.getInstance(p , new Authenticator() {
        @Override 
        protected PasswordAuthentication getPasswordAuthentication() {
         return new PasswordAuthentication(myAccountEmail, password);
      }
        });
        try{
        
        Message message = prepareMessage(session , myAccountEmail ,freelancer );
         Transport.send(message);
             System.out.println("Message sent successfully");
         } catch(Exception ex){
            System.err.println(ex.getMessage());
        }
       
    
    
    }

    private static Message prepareMessage(Session session, String myAccountEmail, freelancer freelancer) {
        try{
            Message message = new MimeMessage(session);
            message.setFrom(new InternetAddress(myAccountEmail));
            message.setRecipient(Message.RecipientType.TO, new InternetAddress(freelancer.getEmail()));
            message.setSubject("khedma");
            String htmlcode="  <center><img src=\"http://image.noelshack.com/fichiers/2023/09/4/1677711658-logo.png\" alt=\"Khedma\" height=50%;width=50%></center>"

                    + "<center><h2>Bienvenue sur notre site  KHEDMA</h2> <br><h4>Facilite votre travaille avec khedma </h4></center></br>"
                  ;

              

            message.setContent(htmlcode,"text/html");
            return message;
        } catch(Exception ex){
            System.err.println(ex.getMessage());
        }
        return null;
    }

  

    
}