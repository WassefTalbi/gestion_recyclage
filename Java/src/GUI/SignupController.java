/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package User.GUI;

import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.AnchorPane;

/**
 * FXML Controller class
 *
 * @author donia
 */
public class SignupController implements Initializable {

    @FXML
    private AnchorPane left_main;
    @FXML
    private Button submitButton;
    @FXML
    private TextField cin;
    @FXML
    private TextField nom;
    @FXML
    private TextField prenom;
    @FXML
    private TextField Tel;
    @FXML
    private TextField email;
    @FXML
    private PasswordField mdp;
    @FXML
    private Label file_path;
    @FXML
    private Button Login;
    @FXML
    private PasswordField role;
    @FXML
    private PasswordField age;
    @FXML
    private PasswordField domaine;
    @FXML
    private PasswordField metier;
    @FXML
    private PasswordField sexe;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

    @FXML
    private void signup(ActionEvent event) {
    }

    @FXML
    private void Login(ActionEvent event) {
    }

    @FXML
    private void link99(MouseEvent event) {
    }
    
}
