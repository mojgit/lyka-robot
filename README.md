# Robot Test App

### How to run the code

You can run the project using docker and dev-containers. You need to install docker desktop on you machine.

-   Clone this Repository and `cd` to the project directory.
-   Run `docker compose up -d` or `./bin/sail/up -d`
-   SSH into the php docker container.
-   Run `composer update`
-   Run `cp .env.example .env`
-   Run `php artisan key:generate`

---

### Part One

We have installed a robot in our warehouse and now we need to be able to send commands to control it. We need you to implement the primary control mechanism.

For convenience the robot moves along a grid in the roof of the warehouse and we've made sure that all of our warehouses are built so that the dimensions of the grid are 10 by 10. We've also made sure that all our warehouses are aligned along north-south and east-west axes.

All of the commands to the robot consist of a single capital letter and different commands are delineated by whitespace.

#### Requirements

-   Create a way to send a series of commands to the robot
-   Make sure the robot doesn't try to break free and move outside the boundary of the warehouse

The robot should accept the following commands:

-   N move north
-   W move west
-   E move east
-   S move south

#### Example command sequences

The command sequence: "N E S W" will move the robot in a full square, returning it to where it started.

If the robot starts in the south-west corner of the warehouse then the following commands will move it to the middle of the warehouse.

"N E N E N E N E"

---

### Part two - Make the robot lift

The robot is equipped with a lifting claw which can be used to move crates around the warehouse. We track the locations of all the crates in the warehouse.

Model the presence of crates in the warehouse. Initially one is in the centre and one in the north-east corner.

Extend the robot's commands to include the following:

-   G grab a crate and lift it
-   D drop a crate gently to the ground

There are some rules about moving crates:

-   The robot should not try and lift a crate if it already lifting one
-   The robot should not lift a crate if there is not one present
-   The robot should not drop a crate on another crate!
