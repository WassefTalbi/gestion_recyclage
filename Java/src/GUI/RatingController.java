package GUI;

import java.net.URL;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.ResourceBundle;
import javafx.beans.value.ObservableValue;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Label;
import javafx.scene.layout.AnchorPane;
import Utils.MyDB;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

import org.controlsfx.control.Rating;
 
public class RatingController implements Initializable {

    private Rating rate;
    @FXML
    private Label msg;
    @FXML
    private AnchorPane ratingLabel;
    @FXML
    private Rating rating;
        Connection cnx;


    /**
     * Initializes the controller class.
     * @param url
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
            
        
    }     int res;
            public int afficherRatingById(int idevent) {
               
        try {
            String qry = "SELECT `rating`  FROM `rating` WHERE id_evenement= '"+ idevent+"'";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while (rs.next()) {
                res=(rs.getInt(1));

            }
            return res;

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return res;
    }
                
    public void add(int t,int evid) {
        try {
           
            String qry = "UPDATE `rating` SET rating='"+t+"' where `id_evenement`='"+evid+"' ";
            cnx = MyDB.getInstance().getCnx();
//
            Statement stm = cnx.createStatement();

            stm.executeUpdate(qry);
            System.out.println("Ajout avec succès!");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
}
