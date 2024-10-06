package com.example.hk_attendance.remote;

public class APIUtils {
    private APIUtils(){


    }
    public static final String API_URL = "http://127.0.0.1:8000/";
    public static StudentsService getStudentsService(){
        return RetrofitClient.getClient(API_URL).create(StudentsService.class);
    }
}
