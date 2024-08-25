package com.example.hk_attendance

import android.os.Bundle
import android.text.method.HideReturnsTransformationMethod
import android.text.method.PasswordTransformationMethod
import android.view.MotionEvent
import android.view.View
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.hk_attendance.databinding.ActivityMainBinding

class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding
    private var isPasswordVisible: Boolean = false
    lateinit var etUsername : EditText
    lateinit var etPassword : EditText
    lateinit var btLogin : Button


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        binding.etPassword.setOnTouchListener { v, event ->
            if (event.action == MotionEvent.ACTION_UP) {
                // Check if the touch is within the bounds of the drawableRight
                val drawableEnd = 2 // This means right drawable
                if (event.rawX >= ((binding.etPassword.right - binding.etPassword.compoundDrawables[drawableEnd]?.bounds?.width()!!)
                        ?: 0)
                ) {
                    togglePasswordVisibility()
                    return@setOnTouchListener true
                }
            }
            false
        }

        binding.btLogin.setOnClickListener(View.OnClickListener {
            if (binding.etUsername.text.toString() == "user" && binding.etPassword.text.toString() == "1234"){
                Toast.makeText(this, "Login Successful!", Toast.LENGTH_SHORT).show()
            }else{
                Toast.makeText(this, "Login Failed!", Toast.LENGTH_SHORT).show()
            }
        })
    }

    private fun togglePasswordVisibility() {
        if (isPasswordVisible) {
            // Hide the password
            binding.etPassword.transformationMethod = PasswordTransformationMethod.getInstance()
            binding.etPassword.setCompoundDrawablesWithIntrinsicBounds(
                R.drawable.baseline_lock_24, 0, R.drawable.baseline_remove_red_eye_24_green, 0
            )
        } else {
            // Show the password
            binding.etPassword.transformationMethod = HideReturnsTransformationMethod.getInstance()
            binding.etPassword.setCompoundDrawablesWithIntrinsicBounds(
                R.drawable.baseline_lock_24, 0, R.drawable.baseline_remove_red_eye_24, 0
            )
        }
        // Toggle the boolean value
        isPasswordVisible = !isPasswordVisible

        // Move the cursor to the end of the text
        binding.etPassword.setSelection(binding.etPassword.text.length)
    }
}