/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Entities;

/**
 *
 * @author donia
 */
public class SingleMail {

    private String mail;
    private final static SingleMail INSTANCE = new SingleMail();

    public SingleMail() {
    }

    public static SingleMail getInstance() {
        return INSTANCE;
    }

    public void setMail(String p) {
        System.out.println( " set Mail "+ p);
        this.mail = p;
    }

    public String getMail() {
        System.out.println("Get Mail"+ this.mail);;
        return this.mail;
    }
}
