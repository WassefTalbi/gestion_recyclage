/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package khedmaEntity;

/**
 *
 * @author DELL
 */
public class Classification {
     private int id;
    private String nom,domaine;

    public Classification() {
    }

    public Classification(String nom, String domaine) {
        this.nom = nom;
        this.domaine = domaine;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getDomaine() {
        return domaine;
    }

    public void setDomaine(String domaine) {
        this.domaine = domaine;
    }

    @Override
    public String toString() {
        return "Classification{" +" nom=" + nom + ", domaine=" + domaine + '}';
    }
    
}
