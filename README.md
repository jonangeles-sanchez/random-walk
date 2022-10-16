### The assignment

-Add a "No Limit" option to the "walk length" drop down list and have that preselected
    -When this option is chosen, you should calculate the maximum number of times the alphabet could be repeated on the size board that is selected and set the walk length to that value.
    -Make this field "sticky"

-By default, have the "grid size" drop down preselected to 25
    -Make this field "sticky"

-Make the "random seed" text input "sticky"
    -That means it should display the most recently produced/selected seed so it can be used again if desired
    -When the page is first loaded, make this field empty
    -Remove the "seed=xxxxxxxx" that used to be displayed above the grid. It is now part of the text input field

-Since "Submit" will always use the displayed value of the seed field unless you change it, add a "Clear and Submit" button
    -This button will clear the "random seed" field using JavaScript before it submits the form so we get a new random seed

-Add an "In Color" checkbox that, when selected, will colorize the output
    -This option should choose random rgb values for each run of the alphabet
    -This option should be selected by default, but also be "sticky"
    -Every time you hit "submit," the random pattern should stay the same, but the random colors should change
        -This one is a bit tricky since there can be only one random number generator per php process
        -HINT: the number generator can be seeded after it has been already been used to generate a series of random values
    -When this option is unchecked, all letters should be black
-Grid dots are always light gray

## Approaches by Howard
* Have array that stores information sbout the styling for each cell
* Store the string specifying the td, style, and content in the grid rather than just the character alone


### Working with GitHub
instructions go here
