/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Services;

import Entities.Metier;
import GUI.FXMain;
import Utils.MyDB;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;

/**
 *
 * @author Safe
 */
public class ServiceMetier implements IServices<Metier>{
    Connection cnx;
    @Override
    public void add(Metier t) {
         try {
        String qry ="INSERT INTO `metier`( `nom`, `type`, `description`,`image`) VALUES ('"+t.getNom()+"','"+t.getType()+"','"+t.getDescription()+"','"+t.getImage()+"')";
        cnx = MyDB.getInstance().getCnx();
      
            Statement stm =cnx.createStatement();
            
            stm.executeUpdate(qry);
            
        } catch (SQLException ex) {
             System.out.println(ex.getMessage());
        }
    }
   
    public ObservableList<Metier> afficherData() {
        ObservableList<Metier> metiers = FXCollections.observableArrayList();
        try {
            PreparedStatement qry =cnx.prepareStatement("SELECT * FROM `metier` WHERE `archive`='"+0+"'  ");
            cnx = MyDB.getInstance().getCnx();
           
            ResultSet rs = qry.executeQuery();
            while(rs.next()){
                Metier m =new Metier();
                m.setId(rs.getInt(1));
                m.setNom(rs.getString("nom"));
                m.setType(rs.getString(3));
                m.setDescription(rs.getString("Description"));
                m.setImage(rs.getString("image"));
                metiers.add(m);
            }
            return metiers;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return metiers;
    }
    @Override
    public List<Metier> afficher() {
        List<Metier> metiers = new ArrayList();
        try {
            String qry ="SELECT * FROM `metier` WHERE `archive`='"+0+"'  ";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
                Metier m =new Metier();
                m.setId(rs.getInt(1));
                m.setNom(rs.getString("nom"));
                m.setType(rs.getString(3));
                m.setDescription(rs.getString("Description"));
                m.setImage(rs.getString("image"));
                metiers.add(m);
            }
            return metiers;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return metiers;
    }
    
    public List<Metier> afficherArchive() {
        List<Metier> metiers = new ArrayList();
        try {
            String qry ="SELECT * FROM `metier` WHERE `archive`='"+1+"'  ";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
                Metier m =new Metier();
                m.setId(rs.getInt(1));
                m.setNom(rs.getString("nom"));
                m.setType(rs.getString(3));
                m.setDescription(rs.getString("Description"));
                m.setImage(rs.getString("image"));
                metiers.add(m);
            }
            return metiers;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return metiers;
    }
    
       public int getIdByNom(String n){
           int m =0;
            try {
            String qry ="SELECT id FROM `metier` WHERE `nom`='"+n+"'  ";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
                
                
                m=(rs.getInt(1));
                
                
            }
            return m;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return m;
       }
       public List<String> afficherAllNames() {
        List<String> metiers = new ArrayList();
        try {
            String qry ="SELECT nom FROM `metier` WHERE `archive`='"+0+"'  ";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
                String m =new String();
                
                m=(rs.getString("nom"));
                
                metiers.add(m);
            }
            return metiers;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return metiers;
    }
              public List<String> afficherAllNamesExcept(String str) {
        List<String> metiers = new ArrayList();
        try {
            String qry ="SELECT nom FROM `metier` WHERE `archive`='"+0+"'  ";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
                String m =new String();
                
                m=(rs.getString("nom"));
                
                metiers.add(m);
            }
                metiers.remove(str);
            return metiers;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return metiers;
    }
        public  String afficherById(int idm) {
        String res="";
        try {
            String qry ="SELECT `nom` FROM `metier` WHERE `id`='"+idm+"' ";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
               
              
                res=(rs.getString("nom"));
                
              
             
            }
            return res;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return res;
    }

    @Override
    public void modifier(Metier m) {
       try {
       String qry = "UPDATE `metier` SET `nom`='" + m.getNom() + "', `type`='" + m.getType() + "', `description`='" + m.getDescription() +  "', `image`='" + m.getImage()+"' WHERE `id`='" + m.getId()+ "'";

      cnx = MyDB.getInstance().getCnx();
      
            Statement stm =cnx.createStatement();
            
            stm.executeUpdate(qry);
            System.out.println("Success!");
        } catch (SQLException ex) {
             System.out.println(ex.getMessage());
        }
    }

    @Override
    public void supprimer(Metier m) {
          try {
            
            String qry="UPDATE `metier` SET `archive` ='" + "1"  + "' WHERE `id`='" + m.getId()+ "'";
            cnx = MyDB.getInstance().getCnx();
      
            Statement stm =cnx.createStatement();
            
            stm.executeUpdate(qry);
              System.out.println("Row deleted successfully!");
        }   catch (SQLException ex) {
             System.out.println(ex.getMessage());
        }
    }
    public String getImgById(int id){
    String res="";
        try {
            String qry ="SELECT `image` FROM `metier` WHERE `id`='"+id+"' ";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
               
              
                res=(rs.getString("image"));
                
              
             
            }
            return res;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return res;
    
    }
    

public List<String> getAllMetierNames() {
    List<String> MetierNames = new ArrayList<>();
    try {
        String query = "SELECT nom FROM metier";
        Connection connection = MyDB.getInstance().getCnx();
        Statement statement = connection.createStatement();
        ResultSet resultSet = statement.executeQuery(query);
        while (resultSet.next()) {
            MetierNames.add(resultSet.getString("nom"));
        }
    } catch (SQLException ex) {
        System.out.println(ex.getMessage());
    }
     
    return MetierNames;
   
}

    @Override
    public void modifierr(int id, Metier entity) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
    

    
}
