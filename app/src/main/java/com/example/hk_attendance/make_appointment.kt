package com.example.hk_attendance
import android.graphics.Color
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import android.widget.CalendarView


class make_appointment : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val calendarView: CalendarView = findViewById(R.id.calendarView)
        calendarView.setBackgroundColor(Color.parseColor("#FFB30B"))
    }
}
