<?php

$javaCode=<<<JAVA_CODE

<script type='text/javascript'>

function Person(gender)
{
	this.sex = gender;
}

Person.prototype.sayHello = function()
{
	alert("I am a person, my gender is " + this.sex);
};

Person.prototype.sayGoodbye = function()
{
	alert("Good bye, I am a" + this.sex);
};

function Student(gender)
{
	Person.call(this,gender);
}

Student.prototype = Object.create(Person.prototype);

Student.prototype.sayHello = function()
{
	Person.prototype.sayHello.call(this);
	alert("I am a student! I am a "+this.sex);
};

var person1 = new Person('Male');
var person2 = new Person('Female');
var student1 = new Student('biSexual');

</script>

JAVA_CODE;

function modeOrder()
{
	global $javaCode;
    echo $javaCode;    
	echo "<script type='text/javascript'>student1.sayHello();</script>";
}

?>