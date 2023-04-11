/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import Entities.User;
import Services.ServiceUser;
import Utils.MyDB;
import com.jfoenix.controls.JFXTextField;
import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
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
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;
import javafx.stage.StageStyle;
import javax.swing.JOptionPane;

/**
 * FXML Controller class
 *
 * @author donia
 */
public class AddAdminController implements Initializable {

    @FXML
    private StackPane rootPane;
    @FXML
    private AnchorPane mainContainer;
    @FXML
    private JFXTextField prenom;
    @FXML
    private JFXTextField cin;
    @FXML
    private JFXTextField mail;
    @FXML
    private JFXTextField mdp;
    @FXML
    private JFXTextField phone;
    @FXML
    private JFXTextField adresse;
    @FXML
    private JFXTextField nom;
     Boolean IsEditibale = false ;
     String role = "Admin";
     ServiceUser su = new ServiceUser();
     int id ;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

   
        public void inflateUI(User place) {

    }
        
                
    

    @FXML
    private void LoadCancel(ActionEvent event) {
        closeStage();
    }
    public void closeStage() {
        ((Stage) adresse.getScene().getWindow()).close();
    }

    
      
    @FXML
    private void LoadAddAdmin(ActionEvent event) {
        
                String anom = nom.getText() ;
        String aprenom = prenom.getText() ;
        int acin = Integer.parseInt(cin.getText()) ;
        String amail = mail.getText() ;
          int aphone = Integer.parseInt(phone.getText()) ;
        String amdp = mdp.getText() ;
        String adr = adresse.getText() ;
        if ( anom.isEmpty() || aprenom.isEmpty()  || amail.isEmpty() || amdp.isEmpty() || adr.isEmpty()  ){
        JOptionPane.showMessageDialog(null, " champs obligatoire !");
        return ;
        }
        
         if ( amail.isEmpty() || (amail.matches("^(.+)@(.+)$")==false) ){
        JOptionPane.showMessageDialog(null, " Invalid Email");
        return ;
        }
      
     
        if (cin.getText().length()!=8){
            
           JOptionPane.showMessageDialog(null, " Cin must exceed 8 Number !");
        
         return ;
           
        }
                                                                                    
        
  if (phone.getText().length()!=8){
         JOptionPane.showMessageDialog(null, "  Nb de Tel faible ou invalide");
          
             return ; 
           
        }
      
        if (IsEditibale) {
            handleEditOperation();
            return;
        }    
        User pv = new User(anom, aprenom,acin,role, amail, amdp,adr ,aphone) ; 
         su.add(pv);
         closeStage();
    }
private void handleEditOperation(){
    User us = new User(id ,nom.getText(), prenom.getText(),Integer.parseInt(phone.getText()),role ,mail.getText(),mdp.getText(),adresse.getText(),Integer.parseInt(phone.getText())) ;

    System.out.println(us.toString());
    su.modifierr(us);
    JOptionPane.showMessageDialog(null, " Success");
    closeStage();
}

    void infalteUI(User place) {
        nom.setText(place.getNom());
        prenom.setText(place.getPrenom());
        cin.setText(String.valueOf(place.getCin()));
        mail.setText(place.getEmail());
        mdp.setText(place.getMdp());
        adresse.setText(place.getAdresse());
        phone.setText(String.valueOf(place.getTelephone()));
        id = place.getId() ;
       IsEditibale = Boolean.TRUE;    }

    @FXML
    private void retour(ActionEvent event) {
          try {
            Parent root=FXMLLoader.load(getClass().getResource("/GUI/AdminPanel.fxml"));
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
