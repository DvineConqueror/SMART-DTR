package com.example.hk_attendance

import android.os.Bundle
import android.widget.Button
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import com.example.hk_attendance.databinding.ActivityMainStudentBinding
import com.google.android.material.bottomsheet.BottomSheetDialog
import androidx.appcompat.app.AlertDialog

class MainActivityStudent : AppCompatActivity() {

    private lateinit var binding : ActivityMainStudentBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainStudentBinding.inflate(layoutInflater)
        setContentView(binding.root)
        replaceFragment(home_page_student())

        binding.btmNavView.setOnItemSelectedListener{

            when(it.itemId){

                R.id.home_btn ->replaceFragment(home_page_student())
                R.id.appointment_btn ->replaceFragment(student_appointment())
                R.id.menu_btn ->showBottomSheetDialog()

                else->{


                }
            }
            true
        }
    }

    private fun replaceFragment(fragment: Fragment){
        val fragmentManager = supportFragmentManager
        val fragmentTransaction = fragmentManager.beginTransaction()
        fragmentTransaction.replace(R.id.frameLayout,fragment)
        fragmentTransaction.commit()
    }

    private fun showBottomSheetDialog() {
        val bottomSheetDialog = BottomSheetDialog(this)
        val view = layoutInflater.inflate(R.layout.bottom_sheet_layout, null)

        bottomSheetDialog.setContentView(view)
        bottomSheetDialog.show()

        // Optionally, handle button clicks in the Bottom Sheet
        val button1 = view.findViewById<Button>(R.id.button1)
        val button2 = view.findViewById<Button>(R.id.button2)
        val button3 = view.findViewById<Button>(R.id.button3)
        val button4 = view.findViewById<Button>(R.id.button4)

        button1.setOnClickListener {
            // Handle Button 1 click
            replaceFragment(change_password())
            bottomSheetDialog.dismiss()
        }
        button2.setOnClickListener {
            // Handle Button 2 click
            replaceFragment(account_details_student())
            bottomSheetDialog.dismiss()
        }
        button3.setOnClickListener {
            replaceFragment(student_history())
            bottomSheetDialog.dismiss()
        }
        button4.setOnClickListener {
            // Handle Button 4 click
            bottomSheetDialog.dismiss()
        }
    }

    private fun showLogoutDialog() {
        // Inflate the custom dialog layout
        val dialogView = layoutInflater.inflate(R.layout.log_out, null)

        val builder = AlertDialog.Builder(this)
        builder.setView(dialogView)

        val alertDialog = builder.create()

        // Initialize buttons
        val buttonYes = dialogView.findViewById<Button>(R.id.logout)
        val buttonNo = dialogView.findViewById<Button>(R.id.cancel_button)

        buttonYes.setOnClickListener {
            // Handle logout action
            // For example, navigate to the login screen or clear user data
            alertDialog.dismiss()
            // Example: startActivity(Intent(this, LoginActivity::class.java))
            // finish() // Optional: close this activity
        }

        buttonNo.setOnClickListener {
            alertDialog.dismiss() // Just dismiss the dialog
        }

        alertDialog.show()
    }


}