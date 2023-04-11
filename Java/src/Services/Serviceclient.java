/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Services;



import Entities.client;
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


/**
 *
 * @author DELL
 */public class Serviceclient implements IServices<client>{
    Connection cnx;
     private Statement ste;
   
     
         public client getUserByEmail(String email) {
        client client = null;
        try {
            cnx = (Connection) Utils.MyDB.getInstance().getCnx();
            PreparedStatement preparedStatement = cnx.prepareStatement("SELECT * FROM user WHERE email = ?");
            preparedStatement.setString(1, email);
            ResultSet rs = preparedStatement.executeQuery();
            ste = cnx.createStatement();
            if (rs.next()) {
                client = new client();
                client.setId(rs.getInt(1));
                client.setNom(rs.getString("nom"));
                client.setPrenom(rs.getString("prenom"));
                client.setCin(rs.getInt("cin"));
                client.setDomaine(rs.getString("domaine"));
                client.setRole(rs.getString("role"));

                client.setEmail(rs.getString("email"));
                client.setMdp(rs.getString("mdp"));
                client.setAdresse(rs.getString("adresse"));
                client.setTelephone(rs.getInt("telephone"));

            }

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return client;
    }
     
     
     
     
     
     
     
     
     
     
     public List<String> afficherAllEmails() {
        List<String> clients = new ArrayList();
        try {
            String qry ="SELECT email FROM user WHERE `archive`='"+0+"'  ";
            cnx = Utils.MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
                String m =new String();
                
                m=(rs.getString("email"));
                
                clients.add(m);
            }
            return clients;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return clients;
    }          
 
    public void add(client t) {
         try {
        String qry ="INSERT INTO `user`( `nom`, `prenom`, `cin`, `telephone`, `adresse`, `role`,`email`, `mdp`,`domaine`, `Image`,`Github_Username`)  VALUES ('"+t.getNom()+"','"+t.getPrenom()+"','"+t.getCin()+"','"+t.getTelephone()+"','"+t.getAdresse()+"','"+t.getRole()+"','"+t.getEmail()+"','"+t.getMdp()+"','"+t.getDomaine()+"','" + t.getImage()+ "','" + t.getGUserName()+ "')";
      cnx = (Connection) MyDB.getInstance().getCnx();
      
            Statement stm =cnx.createStatement();
            
            stm.executeUpdate(qry);
        } catch (SQLException ex) {
             System.out.println(ex.getMessage());
        }
    
    }

    @Override
    public List<client> afficher() {
        
         List<client> clients = new ArrayList<>();
        try {
            String qry ="SELECT * FROM `user` WHERE `archive`='"+0+"'";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
                client p =new client();
                p.setId(rs.getInt(1));
                p.setNom(rs.getString("nom"));
                p.setPrenom(rs.getString("prenom"));
               
                p.setTelephone(rs.getInt("telephone"));
                p.setAdresse(rs.getString("adresse"));
                p.setRole(rs.getString("role"));
                   p.setMdp(rs.getString("mdp"));
                    p.setCin(rs.getInt("cin"));
                p.setEmail(rs.getString("email"));
                p.setDomaine(rs.getString("domaine"));
                clients.add(p);
            }
            return clients;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return clients;
    }
     public List<String> afficherById(int idc) {
         List<String> clients = new ArrayList<>();
        try {
            String qry ="SELECT * FROM `user` WHERE `archive`='"+0+"' AND `id`='"+idc+"'";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
                client p =new client();
                p.setId(rs.getInt(1));
                p.setNom(rs.getString("nom"));
                p.setPrenom(rs.getString("prenom"));
                p.setTelephone(rs.getInt("telephone"));
                p.setAdresse(rs.getString("adresse"));
                    p.setCin(rs.getInt("cin"));
                p.setEmail(rs.getString("email"));
                p.setDomaine(rs.getString("domaine"));
                clients.add(p.toString());
            }
            return clients;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return clients;
    }

    @Override
    public void modifier(client t) {
         try {
       String qry = "UPDATE user SET nom  ='  " + t.getNom() + " ', prenom='" + t.getPrenom() + "', cin='" + t.getCin() + "', telephone='" + t.getTelephone() +  "', adresse='" + t.getAdresse() + "', role='" + t.getRole() + "', email='" + t.getEmail() + "', mdp='" + t.getMdp() +  "', domaine='" + t.getDomaine() + "' WHERE id=" + t.getId() +  ";";

      cnx = MyDB.getInstance().getCnx();
      
            Statement stm =cnx.createStatement();
            
            stm.executeUpdate(qry);
            
        } catch (SQLException ex) {
             System.out.println(ex.getMessage());
        }
        
    }

    @Override
    public void supprimer(client t) {  
        
         try {
       String qry = "UPDATE `user` SET archive ='" + "1"  + "' WHERE id=" + t.getId() +  ";";

      cnx = MyDB.getInstance().getCnx();
      
            Statement stm =cnx.createStatement();
            
            stm.executeUpdate(qry);
            
        } catch (SQLException ex) {
             System.out.println(ex.getMessage());
        }
    }

    @Override
    public void modifierr(int id, client entity) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

   
    }

   
