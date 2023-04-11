/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package GUI;

/**
 *
 * @author DELL
 */
import Services.Serviceclient;
import Services.Servicefreelancer;
import Entities.client;
import Entities.freelancer;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.stage.Stage;
import javafx.stage.StageStyle;

/**
 *
 * @author DELL
 */
public class mainf extends Application {
    
    public void start(Stage primaryStage) {
        try {       
                        Parent p = FXMLLoader.load(getClass().getResource("login.fxml"));

            Scene scene = new Scene(p);
            
            
            
            primaryStage.initStyle(StageStyle.DECORATED);
            primaryStage.getIcons().add(new Image("./Images/5edma.png"));
            primaryStage.setTitle("5EDMA");
            primaryStage.setFullScreen(false);
            primaryStage.setScene(scene);
            primaryStage.show();

              
    }   catch (IOException ex) {
           System.out.println("Err"+ex.getMessage());
        }
    }
  

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        launch(args);
    }
    

}
