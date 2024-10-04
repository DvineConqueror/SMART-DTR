package com.example.hk_attendance

import android.annotation.SuppressLint
import android.content.Intent
import android.os.Bundle
import android.widget.Button
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat


class activity_user_role : AppCompatActivity() {
    @SuppressLint("MissingInflatedId")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContentView(R.layout.activity_user_role)

        supportActionBar?.hide()

        val btnStudent: Button = findViewById(R.id.btnStudent)
        val btnTeacher: Button = findViewById(R.id.btnTeacher)

        btnStudent.setOnClickListener{
            val intent = Intent(this, ActivityCreateLogin::class.java)
            startActivity(intent)
        }

        btnTeacher.setOnClickListener{
            val intent = Intent(this, ActivityCreateLogin::class.java)
            startActivity(intent)
        }

        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }
    }
}