package com.example.hk_attendance.model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class Students {
    private List<Students> data;
    @SerializedName("id")
    @Expose
    private int id;
    @SerializedName("lastname")
    @Expose
    private String lastname;



    public Students(int id, String lastname){
        this.setId(id);
        this.setLastName(lastname);
    }

    public Students(){

    }

    public int getId(){
       return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getLastName(){
        return lastname;
    }


    public void setLastName(String lastname) {
        this.lastname = lastname;
    }

    public List<Students> getData(){
        return data;
    }

    public void setData(List<Students> data) {
        this.data = data;
    }


}
