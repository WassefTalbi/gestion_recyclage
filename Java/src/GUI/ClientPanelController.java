/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import java.io.IOException;
import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.Optional;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.ButtonType;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;
import javafx.stage.StageStyle;
import Entities.client;
import Services.Serviceclient;
import Entities.SingleMail;
import Entities.User;
import Utils.MyDB;
import com.jfoenix.controls.JFXTextField;
import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;
import javax.swing.JOptionPane;

/**
 * FXML Controller class
 *
 * @author donia
 */
public class ClientPanelController implements Initializable {
        ObservableList<client> list = FXCollections.observableArrayList();



 private Connection cnx = MyDB.getInstance().getCnx();
 Serviceclient su = new Serviceclient() ;
    @FXML
    private AnchorPane left_main;
    @FXML
    private Label file_path;
    @FXML
    private TextField mail ;
    @FXML
    private TextField nom;
    @FXML
    private TextField prenom;
    @FXML
    private TextField cin;
    @FXML
    private TextField Tel;
    @FXML
    private PasswordField mdp;
    @FXML
    private TextField domaine;
    @FXML 
    private TextField adresse;
            
Serviceclient sf = new Serviceclient();
SingleMail smail = SingleMail.getInstance();
String mial =  smail.getMail();
client fr =new client();
    @FXML
    private Button submitButton;
    @FXML
    private Button submitButton1;

    @Override
    public void initialize(URL url, ResourceBundle rb) {
      fr = sf.getUserByEmail(mial);
      initCol();
        System.out.println(" show me  "+  mial);
    }

    private void initCol() {
mail.setText(fr.getEmail());
nom.setText(fr.getNom());
prenom.setText(fr.getPrenom());
cin.setText(String.valueOf(fr.getCin()));
Tel.setText(String.valueOf(fr.getTelephone()));
domaine.setText(fr.getDomaine());
adresse.setText(fr.getAdresse());
mdp.setText(fr.getMdp());
    }

    private Stage getStage() {
        return (Stage) mdp.getScene().getWindow();
    }




    private void closeStage(ActionEvent event) {
        getStage().close();
    }

    @FXML
    private void handleEdit(ActionEvent event) {

/*String ma=  mail.getText();
String no = nom.getText();
String pr = prenom.getText();
 int ci = Integer.parseInt(  cin.getText());
 int te = Integer.parseInt( Tel.getText());
 String me = domaine.getText();
 String ad = adresse.getText();
 String md = mdp.getText();
 client us = new client(me,fr.getId() ,no, pr, ci, ma, md, ad,te);
        System.out.println( "the name we put  "+ us.toString() + " the Original Name  " + fr.toString());
    try {
            sf.modifier(us);

       initCol(); 
    }catch(Exception e){ System.out.println(e.getMessage()); }
    JOptionPane.showMessageDialog(null, " Success");
    
    */
    }

    @FXML
    private void handleDelete(ActionEvent event) {
client us = sf.getUserByEmail(mial);

        Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
        alert.setTitle("Deleting client");
        alert.setContentText("Are you sure want to delete " + us.getNom()+ " ?");
        Optional<ButtonType> answer = alert.showAndWait();
        if (answer.get() == ButtonType.OK) {
            su.supprimer(us);
                try {
                  final Node source = (Node) event.getSource();

          
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("login.fxml"));
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root)); 
            stage.show();
    } catch(Exception e) {
        e.printStackTrace();
    }
             


    }}

    @FXML
    private void retern(ActionEvent event) {
          try {
                  final Node source = (Node) event.getSource();

          
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("FrontClient.fxml"));
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root)); 
            stage.show();
             //closeStage( event);
    } catch(Exception e) {
        e.printStackTrace();
    }
    }
    
}
