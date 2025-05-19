#include <Servo.h>
#include <Stepper.h>

#define STEPS 2048 
#define MOTOR_SPEED 10  

Stepper stepper(STEPS, 8, 10, 9, 11);  
Servo myServo;

String inputString = "";
bool stringComplete = false;

void setup() {
  Serial.begin(9600);
  myServo.attach(6); 
  stepper.setSpeed(MOTOR_SPEED);
}

void loop() {
  if (stringComplete) {
    inputString.trim();

    if (inputString.startsWith("STEP:")) {
      int steps = inputString.substring(5).toInt();
      steps = constrain(steps, -10000, 10000); 
      stepper.step(steps);
    }
    else if (inputString.startsWith("SERVO:")) {
      int angle = inputString.substring(6).toInt();
      angle = constrain(angle, 0, 180);
      myServo.write(angle);
    }

    inputString = "";
    stringComplete = false;
  }
}

void serialEvent() {
  while (Serial.available()) {
    char inChar = (char)Serial.read();
    if (inChar == '\n') {
      stringComplete = true;
    } else {
      inputString += inChar;
    }
  }
}