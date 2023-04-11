/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import com.jfoenix.controls.JFXButton;
import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;
import javafx.stage.StageStyle;

/**
 * FXML Controller class
 *
 * @author donia
 */
public class AdminPanelController implements Initializable {

    @FXML
    private JFXButton AjouAdmin;
    @FXML
    private JFXButton AffichAdmin;
    private JFXButton AjouAdmin1;

    /**
     * Initializes the controller class.
     */
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    
 private void LoadCancel(ActionEvent event) {
        closeStage();
    }
  public void closeStage() {
        ((Stage) AffichAdmin.getScene().getWindow()).close();
    }

    @FXML
    private void LoadAdd(ActionEvent event) {
        try {
            Parent root=FXMLLoader.load(getClass().getResource("/GUI/AddAdmin.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
            closeStage();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
        
    }

    @FXML
    private void LoadShow(ActionEvent event) {
                try {
            Parent root=FXMLLoader.load(getClass().getResource("/GUI/AdminList.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
             closeStage();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private void loadAddFlancer(ActionEvent event) {
                try {
            Parent root=FXMLLoader.load(getClass().getResource("/GUI/AddFreelancer.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
             closeStage();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }


    private void LoadShowFlancer(ActionEvent event) {
                try {
            Parent root=FXMLLoader.load(getClass().getResource("/GUI/FreelancerList.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
             closeStage();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private void LoadAddClient(ActionEvent event) {
                        try {
            Parent root=FXMLLoader.load(getClass().getResource("/GUI/AddClient.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
             stage.show();
             closeStage();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private void LoadShowClient(ActionEvent event) {
                        try {
            Parent root=FXMLLoader.load(getClass().getResource("/GUI/ClientList.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private void logout(ActionEvent event) {
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
    }

    private void LoadAddUser(ActionEvent event) {
                                try {
            Parent root=FXMLLoader.load(getClass().getResource("/GUI/inscription.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private void LoadListC(ActionEvent event) {
          try {
            Parent root=FXMLLoader.load(getClass().getResource("/GUI/ClientList.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private void LoadListF(ActionEvent event) {
        try {
            Parent root=FXMLLoader.load(getClass().getResource("/GUI/FreelancerList.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private Stage getStage() {
        return (Stage) AjouAdmin1.getScene().getWindow();
    }
    private void closeStage(ActionEvent event) {
        getStage().close();
    }
    @FXML
    private void retern(ActionEvent event) {
          try {
                  final Node source = (Node) event.getSource();

          
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("FrontAdmin.fxml"));
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root)); 
            stage.show();
          
    } catch(Exception e) {
        e.printStackTrace();
    } 
        
        
    }
    
}
