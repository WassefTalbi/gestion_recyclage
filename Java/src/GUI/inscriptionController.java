/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import Services.Serviceclient;
import Services.Servicefreelancer;
import Entities.User;
import Entities.client;
import Entities.freelancer;
import com.jfoenix.controls.JFXButton;
import com.jfoenix.controls.JFXTextField;
import java.io.File;
import java.net.URL;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.ArrayList;
import java.util.List;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ChoiceBox;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.TilePane;
import javafx.event.ActionEvent;
import javafx.scene.control.Alert;
import javafx.scene.control.Label;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import javax.swing.JOptionPane;

/**
 * FXML Controller class
 *
 * @author donia
 */
public class inscriptionController implements Initializable {

    @FXML
    private StackPane rootPane;
    @FXML
    private AnchorPane mainContainer;
    @FXML
    private JFXTextField nom;
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
    private JFXTextField domaine;
    @FXML
    private JFXTextField metier;
    TilePane r = new TilePane();
    @FXML
    private ChoiceBox<String> role;
    String st[] = {"Coach", "Client"};
    ObservableList<String> list = FXCollections.observableArrayList(st);
    @FXML
    private JFXButton insert_image;
    @FXML
    private Label file_path;
    @FXML
    private JFXTextField GName;

String res="nodata";
     Boolean IsEditibale = false ;
    private int id;
    /**
     * Initializes the controller class.
     *
     * @FXML private void LoadAddAdmin(ActionEvent event) { FilteredList<Metier>
     * filteredData= new FilteredList<>(listM,b->true);
     * txt_keyword.textProperty().addListener((observable,oldvalue,newvalue)->{
     * filteredData.setPredicate( metier ->{ if(newvalue.isEmpty() || newvalue
     * == null){return true; } String search = newvalue.toLowerCase();
     * if(metier.getNom().toLowerCase().indexOf(search) != -1){ return true; }
     * else if(metier.getType().toLowerCase().indexOf(search) != -1) {return
     * true;} else if(metier.getDescription().toLowerCase().indexOf(search) !=
     * -1) {return true;} return false; }); }); SortedList<Metier> sortedData=
     * new SortedList<>(filteredData);
     * sortedData.comparatorProperty().bind(table.comparatorProperty());
     * table.setItems(sortedData); }
     *
     * @FXML private void LoadCancel(ActionEvent event) {
     *
     * }
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        role.setItems(list);
        domaine.setOpacity(0);
        
        role.setOnAction((event) -> {
    int selectedIndex = role.getSelectionModel().getSelectedIndex();
    String selectedItem = role.getSelectionModel().getSelectedItem();

    System.out.println("Selection made: [" + selectedIndex + "] " + selectedItem);
    System.out.println("   ChoiceBox.getValue(): " + role.getValue());
    if (role.getValue() == "Coach"){
            metier.setOpacity(1);
                domaine.setOpacity(0);


    }else{
    domaine.setOpacity(1);
                metier.setOpacity(0);

    }
});
        // TODO
    }



    @FXML
    private void LoadCancel(ActionEvent event) {
        closeStage();
    }
    public void closeStage() {
        ((Stage) adresse.getScene().getWindow()).close();
    }

    @FXML
    private void LoadAddAdmin(ActionEvent event) throws Exception {

        Boolean verif=false;
    int m;
    String maile;
        String value = (String) role.getValue();
           Servicefreelancer sm =new Servicefreelancer();
            Serviceclient cm =new Serviceclient();
       List<String> lst=new ArrayList<>();
       lst=sm.afficherAllEmails();
       lst=cm.afficherAllEmails();
       maile=mail.getText();
       verif=lst.contains(maile);
        System.out.println(verif);
       
                     
        
       if (verif==true){
            JOptionPane.showMessageDialog(null, "email déja existe"); 
            return;
       }
     
        String anom = nom.getText() ;
        String aprenom = prenom.getText() ;
        int acin = Integer.parseInt(cin.getText()) ;
        String amail = mail.getText() ;
          int aphone = Integer.parseInt(phone.getText()) ;
        String amdp = doHashing(mdp.getText()) ;
        String adr = adresse.getText() ;
         
         String pi1 = file_path.getText() ;
         System.out.println(" mine image  "+ pi1);
        if ( anom.isEmpty() || aprenom.isEmpty()  || amail.isEmpty() || amdp.isEmpty() || adr.isEmpty()|| cin.getText().isEmpty() || phone.getText().isEmpty() ){
         Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Champ Obligatoire");
            alert.show();
        }
             if ( amail.matches("^(.+)@(.+)$")==false ){
          Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setContentText("Email Invalide");
            alert.show();
        }
             if ( pi1 == null  ) {
           JOptionPane.showMessageDialog(null, " champs obligatoire  !");
            return;
        }  
      
     
        if (cin.getText().length()!=8){
            
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setContentText("Cin doit avoir 8 chiffres");
            alert.show();
           
        }
                                                                                   
        
  if (phone.getText().length()!=8){
        Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setContentText("Phone doit avoir 8 chiffres");
            alert.show();
           
        }
  if ( value =="Coach" ){
   String ametier = metier.getText() ;
         if (ametier.isEmpty()){
            
           JOptionPane.showMessageDialog(null, " champs obligatoire  !");
        
         return ;
           
        } 
                 if (IsEditibale) {
            handleEditOperation();
            return;
        }
         Servicefreelancer sf = new Servicefreelancer() ;
             freelancer us = new freelancer(metier.getText(),nom.getText(), prenom.getText(),Integer.parseInt(cin.getText()),value ,mail.getText(),doHashing(mdp.getText()),adresse.getText(),Integer.parseInt(phone.getText()),pi1,GName.getText()) ;
             System.out.println(us.toString());
            sf.add(us);
              MailSender.sendMail(us);
         closeStage();

      
  
  
  
  }else
  {
     String adom = domaine.getText() ;
         if (adom.isEmpty()){
            
           JOptionPane.showMessageDialog(null, " champs obligatoire  !");
        
         return ;
           
        }                 if (IsEditibale) {
            handleEditOperation();
            return;}
                                Serviceclient sc = new Serviceclient();
     client pv = new client(anom, aprenom,acin,adom,value, amail, doHashing(amdp),adr ,aphone,pi1) ; 
         sc.add(pv);
          
         closeStage();

      
  
  
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
String path="";
      @FXML
   public void insertImage(){
        
             FileChooser open = new FileChooser();
        
        Stage stage = (Stage)mainContainer.getScene().getWindow();
        
        File file = open.showOpenDialog(stage);
        
        if(file != null){
            
            String path = file.getAbsolutePath();
            
            path = path.replace("\\", "\\\\");
            
            file_path.setText(path);

            
        }else{
            
            System.out.println("NO DATA EXIST!");
            
        }
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
       IsEditibale = Boolean.TRUE;   
    role.setDisable(true);
    role.setOpacity(0);
    }

    private void handleEditOperation() {
  /*  User us = new User(id ,nom.getText(), prenom.getText(),Integer.parseInt(phone.getText()),role ,mail.getText(),mdp.getText(),adresse.getText(),Integer.parseInt(phone.getText())) ;

    System.out.println(us.toString());
    su.modifier(us);
    JOptionPane.showMessageDialog(null, " Success");
    closeStage();  */  }

}
