/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Entities;

import java.util.Objects;

/**
 *
 * @author DELL
 */
public class User {

    private int id, telephone, cin;
    private String nom, prenom, adresse, role, email, mdp;
    private String Image;
    private String GUserName;

    public User() {
    }

    public User(int id) {
        this.id = id;
    }

    public User(String nom, String prenom, int cin, String role, String email, String mdp, String adresse, int telephone, String Image, String GUserName) {
        this.telephone = telephone;
        this.cin = cin;
        this.nom = nom;
        this.prenom = prenom;
        this.adresse = adresse;
        this.role = role;
        this.email = email;
        this.mdp = mdp;
        this.Image = Image;
        this.GUserName = GUserName;
    }

    public User(int id, String nom, String prenom, int cin, String role, String adresse, String email, String mdp, int telephone, String Image, String GUserName) {
        this.id = id;

        this.telephone = telephone;
        this.cin = cin;
        this.nom = nom;
        this.prenom = prenom;
        this.adresse = adresse;
        this.role = role;
        this.email = email;
        this.mdp = mdp;
        this.Image = Image;
        this.GUserName = GUserName;
    }

    public User(int id, String nom, String prenom, int cin, String adresse, String email, String mdp, int telephone, String Image, String GUserName) {
        this.id = id;

        this.telephone = telephone;
        this.cin = cin;
        this.nom = nom;
        this.prenom = prenom;
        this.adresse = adresse;
        this.role = role;
        this.email = email;
        this.mdp = mdp;
        this.Image = Image;
        this.GUserName = GUserName;
    }

    public User(int id, String nom, String prenom, int cin, String adresse, String email, String mdp, int telephone) {
        this.id = id;

        this.telephone = telephone;
        this.cin = cin;
        this.nom = nom;
        this.prenom = prenom;
        this.adresse = adresse;
        this.role = role;
        this.email = email;
        this.mdp = mdp;

    }
        public User(String nom, String prenom, int cin,String role , String email, String mdp, String adresse,int telephone) {

        this.telephone = telephone;
        this.cin = cin;
        this.nom = nom;
        this.prenom = prenom;
        this.adresse = adresse;
        this.role = role;
        this.email = email;
        this.mdp = mdp;

    }
                public User(int id ,String nom, String prenom, int cin,String role , String email, String mdp, String adresse,int telephone) {
        this.id = id;

        this.telephone = telephone;
        this.cin = cin;
        this.nom = nom;
        this.prenom = prenom;
        this.adresse = adresse;
        this.role = role;
        this.email = email;
        this.mdp = mdp;

    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getTelephone() {
        return telephone;
    }

    public void setTelephone(int telephone) {
        this.telephone = telephone;
    }

    public int getCin() {
        return cin;
    }

    public void setCin(int cin) {
        this.cin = cin;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public String getAdresse() {
        return adresse;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getMdp() {
        return mdp;
    }

    public void setMdp(String mdp) {
        this.mdp = mdp;
    }

    public String getImage() {
        return Image;
    }

    public void setImage(String Image) {
        this.Image = Image;
    }

    public String getGUserName() {
        return GUserName;
    }

    public void setGUserName(String GUserName) {
        this.GUserName = GUserName;
    }

    @Override
    public int hashCode() {
        int hash = 5;
        return hash;
    }

    @Override
    public boolean equals(Object obj) {
        if (this == obj) {
            return true;
        }
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final User other = (User) obj;
        if (this.id != other.id) {
            return false;
        }
        if (this.telephone != other.telephone) {
            return false;
        }
        if (this.cin != other.cin) {
            return false;
        }
        if (!Objects.equals(this.nom, other.nom)) {
            return false;
        }
        if (!Objects.equals(this.prenom, other.prenom)) {
            return false;
        }
        if (!Objects.equals(this.adresse, other.adresse)) {
            return false;
        }
        if (!Objects.equals(this.role, other.role)) {
            return false;
        }
        if (!Objects.equals(this.email, other.email)) {
            return false;
        }
        if (!Objects.equals(this.mdp, other.mdp)) {
            return false;
        }
        if (!Objects.equals(this.Image, other.Image)) {
            return false;
        }
        if (!Objects.equals(this.GUserName, other.GUserName)) {
            return false;
        }
        return true;
    }

    public User(  String nom, String prenom,int cin, String email,String mdp,  String adresse,int telephone) {
        this.telephone = telephone;
        this.cin = cin;
        this.nom = nom;
        this.prenom = prenom;
        this.adresse = adresse;
        this.email = email;
        this.mdp = mdp;
    }

    @Override
    public String toString() {
        return "User{" + ", telephone=" + telephone + ", cin=" + cin + ", nom=" + nom + ", prenom=" + prenom + ", adresse=" + adresse + ", role=" + role + ", email=" + email + ", mdp=" + mdp + ", Image=" + Image + ", GUserName=" + GUserName + '}';
    }

}
