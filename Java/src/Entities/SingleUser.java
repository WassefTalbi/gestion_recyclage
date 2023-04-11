/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Entities;

import Entities.User;
/**
 *
 * @author Nasr
 */
public class SingleUser {
          public User user;
  private final static SingleUser INSTANCE = new SingleUser();
  
  public SingleUser() {}
  
  public static SingleUser getInstance() {
    return INSTANCE;
  }
  
  public void setUser(User p) {
      System.out.println( "the user is"+ p.toString());
    this.user = p;
  }
  
  public User getUser() {
    return this.user;
  }
}
