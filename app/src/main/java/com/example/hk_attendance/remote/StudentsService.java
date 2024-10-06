package com.example.hk_attendance.remote;

import com.example.hk_attendance.model.Students;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.DELETE;
import retrofit2.http.GET;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;

public interface StudentsService {
    @GET("api/students/get")
    Call<Students> getStudents();
    @POST("api/students/")
    Call<Students> addStudents(@Body Students students);
    @PUT("api/students/{id}")
    Call<Students> updateStudents(@Path("id") int id, @Body Students student );
    @DELETE("api/students/{id}")
    Call<Students> deleteStudents(@Path("id") int id);
}
