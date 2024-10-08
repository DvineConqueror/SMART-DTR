package com.example.hk_attendance

import android.content.Intent
import android.os.Bundle
import android.widget.Button
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat

class Teacher_Create_signup : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        this.enableEdgeToEdge()
        setContentView(R.layout.activity_teacher_signup_login)

        supportActionBar?.hide()  // Hide action bar if needed

        // Using findViewById to initialize buttons
        val btnStudent: Button = findViewById(R.id.btn_create_account)
        val btnTeacher: Button = findViewById(R.id.btn_log_in)

        btnStudent.setOnClickListener {
            startActivity(
                Intent(
                    this@Teacher_Create_signup,
                    CreateAccount::class.java
                )
            )
        }

        // Redirects for Teacher button
        btnTeacher.setOnClickListener({
            startActivity(
                Intent(
                    this@Teacher_Create_signup,
                    StudentLogin::class.java
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