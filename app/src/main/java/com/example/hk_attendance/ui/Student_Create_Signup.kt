package com.example.hk_attendance.ui

import android.os.Bundle
import android.view.View
import android.widget.AdapterView
import android.widget.ArrayAdapter
import android.widget.Spinner
import android.widget.Toast
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.hk_attendance.R

class Student_Create_Signup : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContentView(R.layout.activity_student_create_signup)

        // Setup Sex Spinner
        val spinnerSex: Spinner = findViewById(R.id.spinnerSex)
        val adapterSex: ArrayAdapter<CharSequence> = ArrayAdapter.createFromResource(
            this,
            R.array.sex_options,
            android.R.layout.simple_spinner_item
        )
        adapterSex.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
        spinnerSex.adapter = adapterSex


        // Setup Year Level Spinner
        val spinnerYearLevel: Spinner = findViewById(R.id.spinnerYearLevel)
        val adapterYearLevel: ArrayAdapter<CharSequence> = ArrayAdapter.createFromResource(
            this,
            R.array.year_level_options,
            android.R.layout.simple_spinner_item
        )
        adapterYearLevel.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
        spinnerYearLevel.adapter = adapterYearLevel
    }
}