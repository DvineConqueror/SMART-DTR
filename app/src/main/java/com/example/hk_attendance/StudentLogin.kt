package com.example.hk_attendance

import android.annotation.SuppressLint
import android.content.Intent
import android.os.Bundle
import android.text.InputType
import android.view.MenuItem
import android.view.MotionEvent
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.appcompat.widget.Toolbar
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.hk_attendance.databinding.ActivityStudentLoginBinding


class StudentLogin : AppCompatActivity() {

    private lateinit var binding: ActivityStudentLoginBinding
    private var isPasswordVisible: Boolean = false

    // Declare your EditText and Button here
    private lateinit var etEmailAddress: EditText
    private lateinit var etPassword: EditText
    private lateinit var btLogin: Button

    @SuppressLint("MissingInflatedId")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()

        binding = ActivityStudentLoginBinding.inflate(layoutInflater)
        setContentView(binding.root) // Set content view to the binding root

        // Initialize your views
        val etEmailAddress = binding.etEmailAddress
        val etPassword = binding.etPassword
        val btLogin = binding.btLogin

        val toolbar: Toolbar = findViewById(R.id.toolbar)
        setSupportActionBar(toolbar)
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        binding.etPassword.setOnTouchListener { v, event ->
            if (event.action == MotionEvent.ACTION_UP) {
                val drawableEnd = 2 // This is right drawable
                val drawableRight = binding.etPassword.compoundDrawables[drawableEnd]
                if (drawableRight != null && event.rawX >= (binding.etPassword.right - drawableRight.bounds.width())) {
                    togglePasswordVisibility()
                    return@setOnTouchListener true
                }
            }
            false
        }

        binding.btLogin.setOnClickListener {
            if (etEmailAddress.text.toString() == "testuser" && etPassword.text.toString() == "admin") {
                Toast.makeText(this, "Login Successful!", Toast.LENGTH_SHORT).show()
                // Optionally navigate to another activity
                val intent = Intent(this, MainActivityStudent::class.java) // Example
                intent.flags = Intent.FLAG_ACTIVITY_CLEAR_TASK or Intent.FLAG_ACTIVITY_NEW_TASK
                startActivity(intent)
                finish()
            } else {
                Toast.makeText(this, "Login Failed!", Toast.LENGTH_SHORT).show()
            }
        }

        // Apply window insets for edge-to-edge display
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }
    }

    // Toggle password visibility
    private fun togglePasswordVisibility() {
        isPasswordVisible = !isPasswordVisible
        binding.etPassword.inputType = if (isPasswordVisible) {
            InputType.TYPE_TEXT_VARIATION_VISIBLE_PASSWORD
        } else {
            InputType.TYPE_TEXT_VARIATION_PASSWORD
        }
        binding.etPassword.setSelection(binding.etPassword.text.length) // Move cursor to the end
    }

    // Handle the action bar back button (home button)
    override fun onOptionsItemSelected(item: MenuItem): Boolean {
        return when (item.itemId) {
            android.R.id.home -> {
                onBackPressed() // This will act like the physical back button
                true
            }

            else -> super.onOptionsItemSelected(item)
        }
    }
}
