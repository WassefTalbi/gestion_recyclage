/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import GUI.AdminPanelController;
import Services.Servicefreelancer;
import Services.Servicefreelancer;
import Entities.User;
import Entities.freelancer;
import Entities.freelancer;
import Services.ServiceUser;
import com.jfoenix.controls.JFXTextField;
import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
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
public class AddFreelancerController implements Initializable {

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
     String role = "freelancer";
     Servicefreelancer sf = new Servicefreelancer();
     int id ;
    @FXML
    private JFXTextField metier;
boolean ok = true;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

   
        public void inflateUI(freelancer place) {

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
        String ametier = metier.getText() ;
        if ( anom.isEmpty() || aprenom.isEmpty()  || amail.isEmpty() || amdp.isEmpty() || adr.isEmpty()|| ametier.isEmpty()   ){
        JOptionPane.showMessageDialog(null, " champs obligatoire !");
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
        freelancer pv = new freelancer(anom, aprenom,acin,ametier,role, amail, amdp,adr ,aphone) ; 
         sf.add(pv);
         closeStage();
    }
private void handleEditOperation(){
    freelancer us = new freelancer(id ,nom.getText(), prenom.getText(),Integer.parseInt(cin.getText()),metier.getText(),role ,mail.getText(),mdp.getText(),adresse.getText(),Integer.parseInt(phone.getText())) ;

    System.out.println(us.toString());
    sf.modifier(us);
    JOptionPane.showMessageDialog(null, " Success");
    closeStage();
}

    void infalteUI(freelancer place) {
        nom.setText(place.getNom());
        prenom.setText(place.getPrenom());
        cin.setText(String.valueOf(place.getCin()));
        mail.setText(place.getEmail());
        mdp.setText(place.getMdp());
        adresse.setText(place.getAdresse());
        phone.setText(String.valueOf(place.getTelephone()));
                metier.setText(place.getMetier());

        id = place.getId() ;

       IsEditibale = Boolean.TRUE;    }

}
