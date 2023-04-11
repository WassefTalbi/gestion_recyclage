/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Services;

import Entities.User;
import Entities.client;
import Entities.freelancer;
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
 *
 */
public class Servicefreelancer implements IServices<freelancer> {

    Connection cnx;
    private Statement ste;
     private PreparedStatement pste;
     

    public freelancer getUserByEmail(String email) {
        freelancer freelancer = null;
        try {
            cnx = (Connection) MyDB.getInstance().getCnx();
            PreparedStatement preparedStatement = cnx.prepareStatement("SELECT * FROM user WHERE email = ?");
            preparedStatement.setString(1, email);
            ResultSet rs = preparedStatement.executeQuery();
            ste = cnx.createStatement();
            if (rs.next()) {
                freelancer = new freelancer();
                freelancer.setId(rs.getInt(1));
                freelancer.setNom(rs.getString("nom"));
                freelancer.setPrenom(rs.getString("prenom"));
                freelancer.setCin(rs.getInt("cin"));
                freelancer.setMetier(rs.getString("metier"));
                freelancer.setRole(rs.getString("role"));
                freelancer.setEmail(rs.getString("email"));
                freelancer.setMdp(rs.getString("mdp"));
                freelancer.setAdresse(rs.getString("adresse"));
                freelancer.setTelephone(rs.getInt("telephone"));
                freelancer.setImage(rs.getString("Image"));
                freelancer.setGUserName(rs.getString("Github_Username"));
            }

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return freelancer;
    }

    public void add(freelancer t) {
        try {
            String qry = "INSERT INTO `user`( `nom`, `prenom`, `cin`, `telephone`, `adresse`, `role`,`email`, `mdp`,`metier`, `Image`,`Github_Username`)  VALUES ('" + t.getNom() + "','" + t.getPrenom() + "','" + t.getCin() + "','" + t.getTelephone() + "','" + t.getAdresse() + "','" + t.getRole() + "','" + t.getEmail() + "','" + t.getMdp() + "','" + t.getMetier() + "','" + t.getImage()+ "','" + t.getGUserName()+ "')";
            cnx = (Connection) MyDB.getInstance().getCnx();
            System.out.println(t.getImage());
            Statement stm = cnx.createStatement();

            stm.executeUpdate(qry);
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

    }

    @Override
    public List<freelancer> afficher() {
        List<freelancer> freelancers = new ArrayList<>();
        try {
            String qry = "SELECT * FROM `user` WHERE `archive`='" + 0 + "' ";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while (rs.next()) {
                freelancer p = new freelancer();
                p.setId(rs.getInt(1));
                p.setNom(rs.getString("nom"));
                p.setPrenom(rs.getString("prenom"));
                p.setTelephone(rs.getInt("telephone"));
                p.setAdresse(rs.getString("adresse"));
                p.setRole(rs.getString("role"));
                p.setMdp(rs.getString("mdp"));
                p.setCin(rs.getInt("cin"));
                p.setEmail(rs.getString("email"));
                p.setMetier(rs.getString("metier"));
                freelancers.add(p);
            }
            return freelancers;

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return freelancers;
    }

  @Override
    public void modifier(freelancer t) {
        String role = "freelancer";
        String qry = "UPDATE user SET nom=?,prenom=?,cin=?,metier=?,role=?,email=?,mdp=?,adresse=?,telephone=? WHERE id=?";
            cnx = MyDB.getInstance().getCnx();
        try {
            
            PreparedStatement pst = cnx.prepareStatement(qry);

            pst.setString(1, t.getNom());
            System.out.println(" Nom "+ t.getNom());
            pst.setString(2, t.getPrenom());
             System.out.println(" prrr "+t.getPrenom());
            pst.setInt(3, t.getCin());
            System.out.println(" cin "+ t.getCin());
            pst.setString(4, t.getMetier());
            System.out.println(" met "+ t.getMetier());
            pst.setString(5, role);
            System.out.println(" role "+ role);
            pst.setString(6, t.getEmail());
            System.out.println(" mail "+ t.getEmail());
            pst.setString(7, t.getMdp());
            System.out.println(" mdp "+ t.getMdp());
            pst.setString(8, t.getAdresse());
            System.out.println(" adr "+ t.getAdresse());
            pst.setInt(9, t.getTelephone());
            System.out.println(" tel "+t.getTelephone());
            pst.setInt(10, t.getId());
            System.out.println(" id "+ t.getId());
            System.out.println("done ");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());        }
    }
       
    @Override
    public void modifierr( int id ,freelancer t)    {
     
 
        String req = "UPDATE `user` SET "
                +"`nom`=?,`prenom`=?,`cin`=?,`metier`=?,`email`=?,`mdp`=?,`adresse`=?,`telephone`=?"
                + "WHERE idu = '" + id+ "'";
    
        try {
            pste = cnx.prepareStatement(req);
           pste.setString(1, t.getNom());
            pste.setString(2, t.getPrenom());
          
            pste.setInt(3, t.getCin());
     
            pste.setString(4, t.getMetier());

            pste.setString(5, t.getEmail());
      
            pste.setString(6, t.getMdp());
        
            pste.setString(7, t.getAdresse());
       
            pste.setInt(8, t.getTelephone());
            pste.executeUpdate();
            System.out.println("freelancer modifie");
        } catch (SQLException ex) {
            Logger.getLogger(Servicefreelancer.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
  
    
    
    
    
    
    
    
    
    
   public List<String> afficherAllEmails() {
        List<String> freelancers = new ArrayList();
        try {
            String qry ="SELECT email FROM user WHERE `archive`='"+0+"'  ";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while(rs.next()){
                String m =new String();
                
                m=(rs.getString("email"));
                
                freelancers.add(m);
            }
            return freelancers;
            
            
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return freelancers;
    }          
 



  
    
    
    
        @Override
        public void supprimer(freelancer t) {  
        
         try {
                String qry = "UPDATE user SET archive ='" + "1" + "' WHERE id=" + t.getId() + ";";;

                cnx = MyDB.getInstance().getCnx();

                Statement stm = cnx.createStatement();

                stm.executeUpdate(qry);

            } catch (SQLException ex) {
                System.out.println(ex.getMessage());
            }
        }

  
   
  
    }
