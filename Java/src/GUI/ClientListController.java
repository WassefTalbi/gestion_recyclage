/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;
import Services.Serviceclient;

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

import Entities.freelancer;
import Services.Servicefreelancer;
import Entities.client;
import Utils.MyDB;
import com.jfoenix.controls.JFXTextField;
import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.control.Button;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
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
public class ClientListController implements Initializable {
        ObservableList<client> list = FXCollections.observableArrayList();


    @FXML
    private StackPane rootPane;
    @FXML
    private AnchorPane contentPane;
    @FXML
    private TableView<client> tableView;

    @FXML
    private TableColumn<client , String> nomCol;
    @FXML
    private TableColumn<client , String> prenomCol;
    @FXML
    private TableColumn<client , String> cinCol;
    @FXML
    private TableColumn<client , String> mailCol;
    @FXML
    private TableColumn<client , String> mdpCol;
    @FXML
    private TableColumn<client , String> adresseCol;
    @FXML
    private TableColumn<client , String> phoneCol;
 private Connection cnx = MyDB.getInstance().getCnx();
 Serviceclient su = new Serviceclient() ;
    @FXML
    private TableColumn<client , String> domaineCol;

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        initCol();
        loadData();
    }

    private void initCol() {
        nomCol.setCellValueFactory(new PropertyValueFactory<>("nom"));
        prenomCol.setCellValueFactory(new PropertyValueFactory<>("prenom"));
        cinCol.setCellValueFactory(new PropertyValueFactory<>("cin"));
        mailCol.setCellValueFactory(new PropertyValueFactory<>("email"));
        mdpCol.setCellValueFactory(new PropertyValueFactory<>("mdp"));
        adresseCol.setCellValueFactory(new PropertyValueFactory<>("adresse"));
        phoneCol.setCellValueFactory(new PropertyValueFactory<>("telephone"));
        domaineCol.setCellValueFactory(new PropertyValueFactory<>("domaine"));


    }

    private Stage getStage() {
        return (Stage) tableView.getScene().getWindow();
    }

    private void loadData() {
        list.clear();
        String req = "SELECT * FROM user WHERE role ='client' ";
  
                    PreparedStatement pst;
        try {
            pst = cnx.prepareStatement(req);
            ResultSet result = pst.executeQuery();
            while(result.next()) {
                list.add(new client(result.getString("domaine"),result.getInt("id"), result.getString("nom"), result.getString("prenom"),result.getInt("cin"), result.getString("email"), result.getString("mdp"), result.getString("adresse"), result.getInt("telephone")));    
            }
    } catch (SQLException ex) {
            System.out.println(ex.getMessage());        }
            
        tableView.setItems(list);
    }
    
    @FXML
    private void handlePlaceDelete(ActionEvent event) {
        //Fetch the selected row
        client selectedForDeletion = tableView.getSelectionModel().getSelectedItem();
        if (selectedForDeletion == null) {
            JOptionPane.showMessageDialog(null,"No Place selected ,Please select a Place for deletion.");
            return;
        }

        Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
        alert.setTitle("Deleting client");
        alert.setContentText("Are you sure want to delete " + selectedForDeletion.getNom()+ " ?");
        Optional<ButtonType> answer = alert.showAndWait();
        if (answer.get() == ButtonType.OK) {
            su.supprimer(selectedForDeletion);

                list.remove(selectedForDeletion);

    }}

    @FXML
    private void handleRefresh(ActionEvent event) {
        loadData();
    }

    @FXML
    private void handlePlaceEdit(ActionEvent event) {
        //Fetch the selected row
        client selectedForEdit = tableView.getSelectionModel().getSelectedItem();
        if (selectedForEdit == null) {
            JOptionPane.showMessageDialog(null, "No client selected, Please select a client for edit.");
            return;
        }
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("AddClient.fxml"));
            Parent parent = loader.load();

            AddClientController controller = (AddClientController) loader.getController();
            controller.infalteUI(selectedForEdit);
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("Edit Member");
            stage.setScene(new Scene(parent));
            stage.show();


            stage.setOnHiding((e) -> {
                handleRefresh(new ActionEvent());
            });

        } catch (IOException ex) {
            ex.getMessage();
        }
    }

    private void closeStage(ActionEvent event) {
        getStage().close();
    }

    @FXML
    private void retern(ActionEvent event) {
          
         try {
                  final Node source = (Node) event.getSource();

          
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("AdminPanel.fxml"));
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root)); 
            stage.show();
            closeStage( event);
    } catch(Exception e) {
        e.printStackTrace();
    } 
    }




}
