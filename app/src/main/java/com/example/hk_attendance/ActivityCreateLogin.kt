package com.example.hk_attendance

import android.content.Intent
import android.os.Bundle
import android.view.View
import android.widget.Button
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat

class ActivityCreateLogin : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        this.enableEdgeToEdge()
        setContentView(R.layout.activity_create_login)

        supportActionBar?.hide()  // Hide action bar if needed

        // Using findViewById to initialize buttons
        val btnStudent: Button = findViewById(R.id.btn_create_account)
        val btnTeacher: Button = findViewById(R.id.btn_log_in)

        btnStudent.setOnClickListener {
            startActivity(
                Intent(
                    this@ActivityCreateLogin,
                    CreateAccount::class.java
                )
            )
        }

        // Redirects for Teacher button
        btnTeacher.setOnClickListener ({
            startActivity(
                Intent(
                    this@ActivityCreateLogin,
                    LoginAccount::class.java
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