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
public class CurrentUser {

     public  int currentUserId;
     public static String currentUserName;
     public String currentUserEmail;
     public String currentUserGithub;
     public String githubtoken;

    public String getGithubtoken() {
        return githubtoken;
    }

    public void setGithubtoken(String githubtoken) {
        this.githubtoken = githubtoken;
    }

    public CurrentUser(String githubtoken) {
        this.githubtoken = githubtoken;
    }

    public CurrentUser(String currentUserName, String currentUserEmail, String currentUserGithub) {
        this.currentUserName = currentUserName;
        this.currentUserEmail = currentUserEmail;
        this.currentUserGithub = currentUserGithub;
    }

    public int getCurrentUserId() {
        return currentUserId;
    }

    public String getCurrentUserName() {
        return currentUserName;
    }

    public String getCurrentUserEmail() {
        return currentUserEmail;
    }

    public String getCurrentUserGithub() {
        return currentUserGithub;
    }

    public void setCurrentUserId(int currentUserId) {
        this.currentUserId = currentUserId;
    }

    public void setCurrentUserName(String currentUserName) {
        this.currentUserName = currentUserName;
    }

    public void setCurrentUserEmail(String currentUserEmail) {
        this.currentUserEmail = currentUserEmail;
    }

    public void setCurrentUserGithub(String currentUserGithub) {
        this.currentUserGithub = currentUserGithub;
    }

    @Override
    public String toString() {
        return "CurrentUser{" + "currentUserName=" + currentUserName + ", currentUserEmail=" + currentUserEmail + ", currentUserGithub=" + currentUserGithub + '}';
    }

     
    
}



    

