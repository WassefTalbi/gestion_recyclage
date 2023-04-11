/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

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
import javafx.scene.control.Label;
import javafx.stage.Stage;
import javafx.stage.StageStyle;

/**
 * FXML Controller class
 *
 * @author donia
 */
public class SignInAsController implements Initializable {

    @FXML
    private Label signlabel;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

    @FXML
    
    private void Cancel(ActionEvent event) {
        closeStage();
    }

    @FXML
    private void LoadSignUoAsC(ActionEvent event) {
        
                                try {
            Parent root=FXMLLoader.load(getClass().getResource("/User/GUI/AddClient1.fxml"));
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
    private void LoadSignUpAsF(ActionEvent event) {
                                        try {
            Parent root=FXMLLoader.load(getClass().getResource("/User/GUI/AddFreelancer1.fxml"));
            Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("khedma");
            stage.setScene(new Scene(root));
            stage.show();
            closeStage();
        } catch (IOException ex) {
            Logger.getLogger(AdminPanelController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
          public void closeStage() {
        ((Stage) signlabel.getScene().getWindow()).close();
    }
}
