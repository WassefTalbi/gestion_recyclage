package Services;

import Entities.User;
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

public class ServiceUser implements IServices<User> {

    private Statement ste;
    Connection cnx;

    public User getUserByEmail(String email) {
        User user = null;
        try {
            cnx = (Connection) MyDB.getInstance().getCnx();

            PreparedStatement preparedStatement = cnx.prepareStatement("SELECT * FROM user WHERE email = ?");
            preparedStatement.setString(1, email);
            ResultSet rs = preparedStatement.executeQuery();
            ste = cnx.createStatement();

            if (rs.next()) {
                user = new User();
                user.setId(rs.getInt(1));
                user.setNom(rs.getString("nom"));
                user.setPrenom(rs.getString("prenom"));
                user.setTelephone(rs.getInt("telephone"));
                user.setAdresse(rs.getString("adresse"));
                user.setMdp(rs.getString("mdp"));
                user.setCin(rs.getInt("cin"));
                user.setEmail(rs.getString("email"));
                               user.setImage(rs.getString("Image"));
               user.setGUserName(rs.getString("GUserName"));

            }

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return user;
    }

    /*      public User getUserByEmail (String Email)  {
     List<User> users = new ArrayList<>();
      User u = new User();
   
          String req = "SELECT * from `user` where Email='"+Email+"';";
            try {

            ste = cnx.createStatement();
            ResultSet rs = ste.executeQuery(req);
            
            while(rs.next()){
          
                   u.setId(rs.getInt(1));
               u.setNom(rs.getString("nom"));
               u.setPrenom(rs.getString("prenom"));
                   u.setCin(rs.getInt("cin"));
                      u.setEmail(rs.getString("email"));
                        u.setMdp(rs.getString("mdp"));
                  u.setAdresse(rs.getString("adresse"));
                u.setTelephone(rs.getInt("telephone"));
              
              
                
            
              
                 users.add(u) ;                                   
            }}
            catch (SQLException ex) {
            Logger.getLogger(ServiceUser.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return u;    
    }*/

    public void updateUserPassword(String mail, String newPassword) {
        try {
            String qry = "UPDATE user SET `mdp`='" + newPassword + "' WHERE email = '" + mail + "';";
            ste = cnx.createStatement();
            ste.executeUpdate(qry);
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }

    @Override
    public void add(User t) {
        try {
            String qry = "INSERT INTO `user`( `nom`, `prenom`, `cin`, `role`,`email`, `mdp` , `adresse`, `telephone`,'Image','Github_UserName')  VALUES ('" + t.getNom() + "','" + t.getPrenom() + "','" + t.getCin() + "','" + t.getRole() + "','" + t.getEmail() + "','" + t.getMdp() + "','" + t.getAdresse() + "','" + t.getTelephone() + "'"+t.getImage()+"','"+ t.getGUserName()+"')";
            cnx = MyDB.getInstance().getCnx();

            Statement stm = cnx.createStatement();

            stm.executeUpdate(qry);
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

    }
    
      

    @Override
    public List<User> afficher() {
        List<User> users = new ArrayList<>();
        try {
            String qry = "SELECT * FROM `user`  WHERE `archive`='" + 0 + "' ";
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(qry);
            while (rs.next()) {
                User p = new User();
                p.setId(rs.getInt(1));
                p.setNom(rs.getString("nom"));
                p.setPrenom(rs.getString("prenom"));

                p.setTelephone(rs.getInt("telephone"));
                p.setAdresse(rs.getString("adresse"));
                p.setRole(rs.getString("role"));
                p.setMdp(rs.getString("mdp"));
                p.setCin(rs.getInt("cin"));
                p.setEmail(rs.getString("email"));
                p.setImage(rs.getString("Image"));
                p.setGUserName(rs.getString("Github_UserName"));

                users.add(p);
            }
            return users;

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return users;

    }

    @Override
    public void modifier(User t) {

        try {
            String qry = "UPDATE user SET nom = '" + t.getNom() + "',prenom='" + t.getPrenom() + "', cin='" + t.getCin() + "', role='" + t.getRole() + "', email='" + t.getEmail() + "', mdp =' " + t.getMdp() + " ' , adresse='" + t.getAdresse() + "' ,telephone='" + t.getTelephone() + "',Image="+t.getImage()+"',Github_UserName="+t.getGUserName()+"' WHERE id=" + t.getId() + ";";

            cnx = MyDB.getInstance().getCnx();

            Statement stm = cnx.createStatement();

            stm.executeUpdate(qry);

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

    }

    @Override
    public void supprimer(User t) {

        try {
            String qry = "UPDATE `user` SET archive ='" + "1" + "' WHERE id = '" + t.getId() + "' ";

            cnx = MyDB.getInstance().getCnx();

            Statement stm = cnx.createStatement();

            stm.executeUpdate(qry);

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

    }

    public boolean validate(String Uname, String Upassword) {

        String vd = "SELECT * FROM user WHERE email='" + Uname + "' and mdp='" + Upassword + "' ;";
        try {
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(vd);
            if (rs.next()) {
                return true;
            }
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());;
        }
        return false;
    }

    public String check(String Uname, String Upassword) {
        String vd = "SELECT * FROM user WHERE email='" + Uname + "' and mdp='" + Upassword + "' ;";
        try {
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(vd);
            if (rs.next()) {
                return rs.getString("role");
            }
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());;
        }
        return " rubish ";
    }
    public User takout(String Uname, String Upassword) {
        String vd = "SELECT * FROM user WHERE email='" + Uname + "' and mdp='" + Upassword + "' ;";
        try {
            cnx = MyDB.getInstance().getCnx();
            Statement stm = cnx.createStatement();
            ResultSet rs = stm.executeQuery(vd);
            if (rs.next()) {
               User p = new User();
                p.setId(rs.getInt(1));
                p.setNom(rs.getString("nom"));
                p.setPrenom(rs.getString("prenom"));

                p.setTelephone(rs.getInt("telephone"));
                p.setAdresse(rs.getString("adresse"));
                p.setRole(rs.getString("role"));
                p.setMdp(rs.getString("mdp"));
                p.setCin(rs.getInt("cin"));
                p.setEmail(rs.getString("email"));
                p.setImage(rs.getString("Image"));
                p.setGUserName(rs.getString("Github_UserName")); 
            return p ;
            }
        } catch (SQLException ex) {
            System.err.println(ex.getMessage());;
        }
        return  null;
    }

    @Override
    public void modifierr(int id, User entity) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    public void addU(User u) {
     
        try {
            String qry = "INSERT INTO `user`( `nom`, `prenom`, `cin`, `role`,`email`, `mdp` , `adresse`, `telephone`)  VALUES ('" + u.getNom() + "','" + u.getPrenom() + "','" + u.getCin() + "','" + u.getRole() + "','" + u.getEmail() + "','" + u.getMdp() + "','" + u.getAdresse() + "','" + u.getTelephone() + "')";
            cnx = MyDB.getInstance().getCnx();

            Statement stm = cnx.createStatement();

            stm.executeUpdate(qry);
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

    }
   
    public void modifierr(User t) {

        try {
            String qry = "UPDATE user SET nom = '" + t.getNom() + "',prenom='" + t.getPrenom() + "', cin='" + t.getCin() + "', role='" + t.getRole() + "', email='" + t.getEmail() + "', mdp =' " + t.getMdp() + " ' , adresse='" + t.getAdresse() + "' ,telephone='" + t.getTelephone() + "' WHERE id=" + t.getId() + ";";

            cnx = MyDB.getInstance().getCnx();

            Statement stm = cnx.createStatement();

            stm.executeUpdate(qry);

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

    }

    
    
    
    
    }

