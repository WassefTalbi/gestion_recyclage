/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import Entities.Metier;

import Services.ServiceMetier;
import Utils.MyDB;
import com.jfoenix.controls.JFXButton;
import com.jfoenix.controls.JFXTextField;
import java.awt.Dimension;
import java.awt.Font;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.PrintWriter;
import java.io.Writer;
import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.stream.Collectors;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.collections.transformation.SortedList;
import javafx.collections.FXCollections;
import javafx.event.ActionEvent;
import javafx.event.Event;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Label;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.AnchorPane;
import javafx.scene.text.Text;
import javafx.stage.DirectoryChooser;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import javafx.stage.Window;
import javax.swing.JFileChooser;
import javax.swing.JOptionPane;
import javax.swing.UIManager;
import javax.swing.plaf.FontUIResource;

/**
 * FXML Controller class
 *
 * @author Safe
 */
public class MetierController implements Initializable {
    
    @FXML
    private AnchorPane anch;
    @FXML
    private TableView<Metier> table;
    @FXML
    private TableColumn<Metier, Integer> col_id;
    @FXML
    private TableColumn<Metier, String> col_nom;
    @FXML
    private TableColumn<Metier, String> col_type;
    @FXML
    private TableColumn<Metier, String> col_description;
    @FXML
    private TableColumn<Metier, String> col_image;
    @FXML
    private TextField txt_id;
    @FXML
    private TextField txt_nom;

    @FXML
    private TextField txt_type;

    @FXML
    private TextField txt_description;
    @FXML
    private ImageView image_view;


    @FXML
    private Label filr_path;
    @FXML
    private JFXTextField txt_keyword;

    @FXML
    private JFXButton export_button;
    
    @FXML
    private Label img_label;
    int index= -1;
    Connection conn=null;
    ResultSet rs=null;
    PreparedStatement pst = null;
    
    ServiceMetier sm;
    @FXML
    private JFXButton insert_image;
    /**
     * Initializes the controller class.
     * 
     */
    public void clearTextField(){
        txt_id.clear();
        txt_nom.clear();
        txt_type.clear();
        txt_description.clear();
        image_view.setImage(null);
        filr_path.setText(null);
    }
    Boolean verif=false;
    String nom_metier;
    int m;
    
    @FXML
    public void add_metier(){
        conn=MyDB.getInstance().getCnx();
       ServiceMetier sm =new ServiceMetier();
       List<String> lst=new ArrayList<>();
       lst=sm.afficherAllNames();
       nom_metier=txt_nom.getText();
       verif=lst.contains(nom_metier);
        System.out.println(verif);
       if (verif==true){
                                    UIManager.put("OptionPane.minimumSize",new Dimension(500,200)); 
            UIManager.put("OptionPane.messageFont", new FontUIResource(new Font(  
          "Arial", Font.BOLD, 30)));
            JOptionPane.showMessageDialog(null, "Nom doit etre unique", "Attention!", JOptionPane.INFORMATION_MESSAGE);
            clearTextField();
            return;
            
       }
        String qry ="INSERT INTO `metier`(id, `nom`, `type`, `description`,`image`) VALUES (?,?,?,?,?)";
       
        try {
            pst=conn.prepareStatement(qry);
                 pst.setInt(1, 0);

            pst.setString(2, txt_nom.getText());
            pst.setString(3, txt_type.getText());
            pst.setString(4, txt_description.getText());
            pst.setString(5, filr_path.getText());
            pst.execute();
                          UIManager.put("OptionPane.minimumSize",new Dimension(500,200)); 
            UIManager.put("OptionPane.messageFont", new FontUIResource(new Font(  
          "Arial", Font.BOLD, 30)));
            JOptionPane.showMessageDialog(null, "Metier ajouté avec succés", "Succès!", JOptionPane.INFORMATION_MESSAGE);
            clearTextField();
            updateTable();
        } catch (Exception e) {
                        JOptionPane.showMessageDialog(null, e.getMessage());

        }
    }
       
    @FXML
    public void getSelected(){
        img_label.setVisible(false);
        ServiceMetier sm = new ServiceMetier();
        index = table.getSelectionModel().getSelectedIndex();
        if (index <= -1){
            return;
        }
        txt_id.setText(col_id.getCellData(index).toString());
        txt_nom.setText(col_nom.getCellData(index).toString());
        txt_type.setText(col_type.getCellData(index).toString());
        txt_description.setText(col_description.getCellData(index).toString());
        String picture ="file:" +  col_image.getCellData(index).toString();
        filr_path.setText(col_image.getCellData(index).toString());
    Image image1 = new Image(picture, 110, 110, false, true);            
            image_view.setImage(image1);
            
    }
    @FXML
    public void edit(){
        verif=false;
         ServiceMetier sm =new ServiceMetier();
       List<String> lst=new ArrayList<>();
       nom_metier=txt_nom.getText();
       lst=sm.afficherAllNamesExcept(nom_metier);
       
       verif=lst.contains(nom_metier);
        System.out.println(verif);
       if (verif==true){
                                    UIManager.put("OptionPane.minimumSize",new Dimension(500,200)); 
            UIManager.put("OptionPane.messageFont", new FontUIResource(new Font(  
          "Arial", Font.BOLD, 30)));
            JOptionPane.showMessageDialog(null, "Nom doit etre unique", "Attention!", JOptionPane.INFORMATION_MESSAGE);
            clearTextField();
            return;
            
       }
        try {
            conn=MyDB.getInstance().getCnx();
            String value1 = col_id.getCellData(index).toString();
            
            String value3 = txt_type.getText();
            String value4 = txt_description.getText();
            String value5 = filr_path.getText();
            String sql="UPDATE `metier` SET  `type`='" + value3 + "', `description`='" + value4 + "', `image`='" + value5 + "' WHERE `id`='" + value1+ "'";
            pst=conn.prepareStatement(sql);
            pst.execute();
                                    UIManager.put("OptionPane.minimumSize",new Dimension(500,200)); 
            UIManager.put("OptionPane.messageFont", new FontUIResource(new Font(  
          "Arial", Font.BOLD, 30)));
            JOptionPane.showMessageDialog(null, "Metier modifié avec succés", "Succés!", JOptionPane.INFORMATION_MESSAGE);
            clearTextField();
            updateTable();

                        
        } catch (Exception e) {
                        JOptionPane.showMessageDialog(null, e.getMessage());

        } 
    }
    @FXML
    public void supprimer(){
        try {
            conn=MyDB.getInstance().getCnx();
            String value1 = col_id.getCellData(index).toString();
            String value2 = txt_nom.getText();
            String value3 = txt_type.getText();
            String value4 = txt_description.getText();
            String sql="UPDATE `metier` SET `archive`='" + 1 + "' WHERE `id`='" + value1+ "'";
            pst=conn.prepareStatement(sql);
            pst.execute();
                                    UIManager.put("OptionPane.minimumSize",new Dimension(500,200)); 
            UIManager.put("OptionPane.messageFont", new FontUIResource(new Font(  
          "Arial", Font.BOLD, 30)));
            JOptionPane.showMessageDialog(null, "Metier supprimé avec succés", "Succés!", JOptionPane.INFORMATION_MESSAGE);
                        clearTextField();

            updateTable();
            

                        
        } catch (Exception e) {
                        JOptionPane.showMessageDialog(null, e.getMessage());

        } 
    }
    public void updateTable(){
        ServiceMetier sm = new ServiceMetier();
        
        List<Metier> metiers = sm.afficher();
        ObservableList<Metier> listM=FXCollections.observableArrayList(metiers);
       col_id.setCellValueFactory(new PropertyValueFactory<Metier,Integer>("id"));
        col_nom.setCellValueFactory(new PropertyValueFactory<Metier,String>("nom"));
        col_type.setCellValueFactory(new PropertyValueFactory<Metier,String>("type"));
        col_description.setCellValueFactory(new PropertyValueFactory<Metier,String>("description"));
        col_image.setCellValueFactory(new PropertyValueFactory<Metier,String>("image"));
        listM=sm.afficherData();
        table.setItems(listM);
        FilteredList<Metier> filteredData= new FilteredList<>(listM,b->true);
       /* txt_keyword.textProperty().addListener((observable,oldvalue,newvalue)->{
            filteredData.setPredicate( metier ->{
                if(newvalue.isEmpty() || newvalue == null){return true; }
                String search = newvalue.toLowerCase();
                if(metier.getNom().toLowerCase().indexOf(search) != -1){
                    return true;
                } else if(metier.getType().toLowerCase().indexOf(search) != -1)  {return true;}
                else if(metier.getDescription().toLowerCase().indexOf(search) != -1)  {return true;}
                return false;
            });
    });
        SortedList<Metier> sortedData= new SortedList<>(filteredData);
        sortedData.comparatorProperty().bind(table.comparatorProperty());
        table.setItems(sortedData);*/
       
       ObservableList<Metier> newdata = listM.stream().filter(n -> n.getNom().toLowerCase().contains(txt_keyword.getText().toLowerCase())
      || n.getType().toLowerCase().contains(txt_keyword.getText().toLowerCase())
      || n.getDescription().toLowerCase().contains(txt_keyword.getText().toLowerCase()))
       .collect(Collectors.toCollection(FXCollections::observableArrayList));
      table.setItems(newdata);
    }
@FXML
private void redirectToSousMetier(ActionEvent event) throws Exception {              
    try {
                  final Node source = (Node) event.getSource();

         
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("SousMetier.fxml"));
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root));
             
            stage.show();
           
    } catch(Exception e) {
        e.printStackTrace();
    }
}
    @FXML
    private void insertImage(Event event) {
         FileChooser open = new FileChooser();
        
        Stage stage = (Stage)anch.getScene().getWindow();
        
        File file = open.showOpenDialog(stage);
        
        if(file != null){
            
            String path = file.getAbsolutePath();
            
            path = path.replace("\\", "\\\\");
            
            filr_path.setText(path);

            Image image = new Image(file.toURI().toString(), 110, 110, false, true);
            img_label.setVisible(false);
            image_view.setImage(image);
            
        }else{
            
            System.out.println("NO DATA EXIST!");
            
        }
    }
public void writeExcel() throws Exception {
    Stage stage=null;
      String directoryPath="";
    DirectoryChooser directoryChooser = new DirectoryChooser();
        File selectedDirectory = directoryChooser.showDialog(stage);
        
        if (selectedDirectory != null) {
            directoryPath = selectedDirectory.getAbsolutePath();
            System.out.println("Selected directory: " + directoryPath);
        }
    
    PrintWriter writer = new PrintWriter( new OutputStreamWriter(new FileOutputStream(directoryPath+"/Metier.csv"), "UTF-8"));
    
     ServiceMetier sm = new ServiceMetier();
        
        List<Metier> metiers = sm.afficherArchive();
       writer.write("Nom,Type,Description,Image Path\n");
               for (Metier obj : metiers) {
                   
            writer.write(obj.getNom().toString());
            writer.write(",");
            writer.write(obj.getType().toString());
            writer.write(",");
            writer.write(obj.getDescription().toString());
            writer.write(",");
            writer.write(obj.getImage().toString());          
            writer.write("\n");

               }
               writer.flush();
               writer.close();
}
@FXML
private void insertExcel() throws IOException, SQLException{
conn=MyDB.getInstance().getCnx();
 String sql="INSERT INTO metier (nom,type,description,image) VALUES (?,?,?,?) ;";
 int batchSize=20;
PreparedStatement pst ;
        String filepath="C:/Users/Safe/Desktop/Metier.csv";
        String filePath="";
        FileChooser fileChooser = new FileChooser();
        Stage stage = null;
        File result = fileChooser.showOpenDialog(stage);
        
        if (result != null) {
     
            String fileName = result.getName();
             filePath = result.getAbsolutePath();
            System.out.println("Selected file: " + fileName);
            System.out.println("File path: " + filePath);
        }
        try {
             filepath=filePath;
           pst = conn.prepareStatement(sql);
            BufferedReader lineReader=new BufferedReader(new FileReader(filePath));
                        String lineText=null;
            int count=0;
             while ((lineText=lineReader.readLine())!=null){
                String[] data=lineText.split(",");
                

                pst = conn.prepareStatement(sql);
                pst.setString(1, data[0]);
                pst.setString(2, data[1]);
                pst.setString(3, data[2]);
                pst.setString(4, data[3]);
                 pst.addBatch();
              if(count%batchSize==0){
                    pst.executeBatch();
                }
        } 
            lineReader.close();
            pst.executeBatch();

                           UIManager.put("OptionPane.minimumSize",new Dimension(500,200)); 
            UIManager.put("OptionPane.messageFont", new FontUIResource(new Font(  
          "Arial", Font.BOLD, 30)));
            JOptionPane.showMessageDialog(null, "Metier(s) insérés avec succés", "Succés!", JOptionPane.INFORMATION_MESSAGE);
            updateTable();
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());
        } catch (FileNotFoundException ex) {
            System.err.println(ex.getMessage());
        } catch (IOException ex) {
            System.err.println(ex.getMessage());
        }
            

}
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        
        col_nom.prefWidthProperty().bind(table.widthProperty().divide(3)); // w * 1/4
        col_type.prefWidthProperty().bind(table.widthProperty().divide(3)); // w * 1/2
        col_description.prefWidthProperty().bind(table.widthProperty().divide(3.04)); // w * 1/4
        updateTable();
    }    
      @FXML
    private void redirecttocompte(ActionEvent event) {
         try {
                  final Node source = (Node) event.getSource();

         
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("AdminPanel.fxml"));
       
             System.out.println("ZZZ");
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
    private void redirecttoProjet(ActionEvent event) {
         try {
                  final Node source = (Node) event.getSource();

         
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("ProjetClient.fxml"));
       
             System.out.println("ZZZ");
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
    private void redirecttometier(ActionEvent event) {
         try {
                  final Node source = (Node) event.getSource();

         
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("Metier.fxml"));
       
             System.out.println("ZZZ");
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
    private void redirectToAnnonce(ActionEvent event) {
         try {
                  final Node source = (Node) event.getSource();

         
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("Annonce.fxml"));
       
             System.out.println("ZZZ");
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
    private void redirecttoevenement(ActionEvent event) {
         try {
                  final Node source = (Node) event.getSource();

         
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("Evenement.fxml"));
       
             System.out.println("ZZZ");
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
    private void signout(ActionEvent event) {
          try {
                  final Node source = (Node) event.getSource();

         
       FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("login.fxml"));
       
             System.out.println("ZZZ");
            Parent root = (Parent) fxmlLoader.load();
           final Stage stage = (Stage) source.getScene().getWindow();
            stage.setScene(new Scene(root));
             
            stage.show();
           
    } 
          catch(Exception e) {
        e.printStackTrace();
    }
        
    }
    
    }
