/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import Entities.SingleUser;
import Entities.User;
import com.jfoenix.controls.JFXButton;
import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.VBox;
import javafx.scene.paint.ImagePattern;
import javafx.scene.shape.Circle;
import javafx.stage.Stage;
import javafx.stage.StageStyle;


public class FrontFreelancerController  implements Initializable {

    @FXML
    private AnchorPane anch;

    @FXML
    private JFXButton ButtonCompte;


    private JFXButton ButtonAnnonce;


    @FXML
    private JFXButton ButtonSignOut;

    @FXML
    private ScrollPane scroll_pane;
    @FXML
    private VBox vbox;
    private Circle UserLogo;
       @FXML
    private ImageView image_view;
           @FXML
    private Label label_name;
    void redirectToAnnonce(ActionEvent event) {
        
       
                
                try {
                  final Node source = (Node) event.getSource();

          FXMLLoader fxmlLoader=null;
      
                 fxmlLoader = new FXMLLoader(getClass().getResource("AnnonceClient.fxml"));
        
    
      // FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("ProjetClient.fxml"));
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root));
             
            stage.show();
           
    } 
          catch(Exception e) {
        e.printStackTrace();
    }


    }

    void redirecttoProjet(ActionEvent event) {
    
                  try {
                  final Node source = (Node) event.getSource();

          FXMLLoader fxmlLoader=null;
      
                 fxmlLoader = new FXMLLoader(getClass().getResource("ProjetFreelancer.fxml"));
        
    
      // FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("ProjetClient.fxml"));
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root));
             
            stage.show();
           
    } 
          catch(Exception e) {
        e.printStackTrace();
    }

    }

    @FXML
    void redirecttocompte(ActionEvent event) {
              try {
                  final Node source = (Node) event.getSource();

         
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("freelancerPanel.fxml"));
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root));
             
            stage.show();
           
    } 
          catch(Exception e) {
        e.printStackTrace();
    }
        

    }

    void redirecttoevenement(ActionEvent event) {
        try {
                  final Node source = (Node) event.getSource();

         
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("EvenementClient.fxml"));
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root));
             
            stage.show();
           
    } 
          catch(Exception e) {
        e.printStackTrace();
    }

    }

    void redirecttometier(ActionEvent event) {
        try {
                  final Node source = (Node) event.getSource();

         
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("MetierClientChart.fxml"));
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root));
             
            stage.show();
           
    } 
          catch(Exception e) {
        e.printStackTrace();
    }
    }

    private Stage getStage() {
        return (Stage) ButtonAnnonce.getScene().getWindow();
    }
 private void closeStage(ActionEvent event) {
        getStage().close();
    }
    @FXML
    void signout(ActionEvent event) {
  try {       
            Parent root=FXMLLoader.load(getClass().getResource("login.fxml"));
             Stage stage = new Stage(StageStyle.DECORATED);
            stage.setTitle("5edma");
             closeStage(event);
            stage.setScene(new Scene(root));
            stage.show();
            
              
    }   catch (IOException ex) {
           System.out.println("Err"+ex.getMessage());
        }
    }
public void loadData(){
SingleUser hold = SingleUser.getInstance();
          User u = hold.getUser(); 
              Image img =new Image(u.getImage());
                      UserLogo.setFill(new ImagePattern(img));


    System.out.println(u.getImage());
}
  
    @Override
    public void initialize(URL location, ResourceBundle resources) {
        SingleUser hold = SingleUser.getInstance();
                  User u = hold.getUser(); 
                  label_name.setText(u.getPrenom()+" "+u.getNom());
                  String picture = "file:"+u.getImage();
                    Image image = new Image(picture, 110, 110, false, true);
            
            image_view.setImage(image);}

}

