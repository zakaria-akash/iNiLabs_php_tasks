<?php

// Define a base class named Animal
class Animal
{
  // Define a method named makeSound in the Animal class
  public function makeSound()
  {
    // Output a generic message indicating that an animal makes a sound
    echo "Animal makes a sound<br>";
  }
}

// Define a subclass named Ant, inheriting from the Animal class
class Ant extends Animal
{
  // Override the makeSound method in the Ant class
  public function makeSound()
  {
    // Output a message indicating the sound made by an ant
    echo "Ant sound: Cry<br>";
  }
}

// Define a subclass named Cheetah, inheriting from the Animal class
class Cheetah extends Animal
{
  // Override the makeSound method in the Cheetah class
  public function makeSound()
  {
    // Output a message indicating the sound made by a cheetah
    echo "Cheetah sound: Bleat<br>";
  }
}

// Define a subclass named Chicken, inheriting from the Animal class
class Chicken extends Animal
{
  // Override the makeSound method in the Chicken class
  public function makeSound()
  {
    // Output a message indicating the sound made by a chicken
    echo "Chicken sound: Chuck<br>";
  }
}

// Instantiate an object of the Ant class and call its makeSound method
$ant = new Ant();
$ant->makeSound(); // Output: Ant barks

// Instantiate an object of the Cheetah class and call its makeSound method
$cheetah = new Cheetah();
$cheetah->makeSound(); // Output: Cheetah meows

// Instantiate an object of the Chicken class and call its makeSound method
$chicken = new Chicken();
$chicken->makeSound(); // Output: Chicken chirps


// Polymorphism: Polymorphism allows objects of different classes to be treated as objects of a common superclass, enabling them to respond differently to the same method call.

/*In the context of the above PHP codes, "Polymorphism" is demonstrated as follows:

--Polymorphism is demonstrated through method overriding, where subclasses (Ant, Cheetah, and Chicken) inherit from a common superclass (Animal) and override the makeSound method to provide their specific sound outputs.

--Despite all objects being created using different subclass types, they are treated uniformly as objects of the superclass Animal.

--When the makeSound method is called on each object, polymorphism ensures that the appropriate overridden method in each subclass is executed, producing different sound outputs for each animal type.*/