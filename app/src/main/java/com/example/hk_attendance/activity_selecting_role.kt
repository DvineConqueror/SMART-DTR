package com.example.hk_attendance

import android.content.Intent
import android.os.Bundle
import android.view.View
import android.widget.Button
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat

class activity_selecting_role : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        this.enableEdgeToEdge()
        setContentView(R.layout.activity_user_role)

        supportActionBar?.hide()  // Hide action bar if needed

        // Using findViewById to initialize buttons
        val btnStudent: Button = findViewById(R.id.btnStudent)
        val btnTeacher: Button = findViewById(R.id.btnTeacher)

        btnStudent.setOnClickListener {
            startActivity(
                Intent(
                    this@activity_selecting_role,
                    MainActivityStudent::class.java
                )
            )
        }

        // Redirects for Teacher button
        btnTeacher.setOnClickListener ({
            startActivity(
                Intent(
                    this@activity_selecting_role,
                    activity_main_teacher::class.java
                )
            )
        })

        // Apply window insets for edge-to-edge display
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }
    }
}