/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Entities;

/**
 *
 * @author azers
 */
public class Tache {
    private int id;
    private int projectId;
    private String nom;
    private String status;
   
    private String description;
    private String priority;
    private int estimatedTime;

    public Tache(int projectId,String nom, String status, String description, String priority, int estimatedTime) {     
        this.projectId = projectId;
        this.nom= nom;
        this.status = status;
        
        this.description = description;
        this.priority = priority;
        this.estimatedTime = estimatedTime;
    }

    public Tache() {
       
    }

    public Tache(String task_1, String description_of_task_1, String todo) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    // getters and setters for all fields

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getProjectId() {
        return projectId;
    }

    public void setProjectId(int projectId) {
        this.projectId = projectId;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

   
    
      public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getPriority() {
        return priority;
    }

    public void setPriority(String priority) {
        this.priority = priority;
    }

    public int getEstimatedTime() {
        return estimatedTime;
    }

    public void setEstimatedTime(int estimatedTime) {
        this.estimatedTime = estimatedTime;
    }
    
    @Override
    public String toString() {
        return "Tache{" +
                "id=" + id +
                ", projectId=" + projectId +
                 ", Nom=" + nom +
                ", status='" + status + '\'' +               
                ", description='" + description + '\'' +
                ", priority='" + priority + '\'' +
                ", estimatedTime=" + estimatedTime +
                '}';
    }
}

