/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Entities;



/**
 *
 * @author Safe
 */
public class Metier {
    private String nom,type,description;
    private int id;
    private String image;
    
    public Metier(){};
    public Metier(int id){
    this.id = id;
    }
    public Metier(String nom, String type, String description,String image) {
        this.nom = nom;
        this.type = type;
        this.description = description;
        this.image =image;
    }
     public Metier(String nom) {
        this.nom = nom;
       
    }
     public Metier(int id,String nom, String type, String description,String image) {
        this.id = id ;
        this.nom = nom;
        this.type = type;
        this.description = description;
        this.image =image;
    }
    public void setId(int id) {
        this.id = id;
    }

    public int getId() {
        return id;
    }
   

    public void setNom(String nom) {
        this.nom = nom;
    }

    public void setType(String type) {
        this.type = type;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getNom() {
        return nom;
    }

    public String getType() {
        return type;
    }

    public String getDescription() {
        return description;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }
    
    @Override
    public String toString() {
        return "Metier{"+"id=" + id  + ", nom=" + nom + ", type=" + type + ", description=" + description + ", image=" + image +  '}';
    }
    
}
