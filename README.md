## The assignment

* ~Add a "No Limit" option to the "walk length" drop down list and have that preselected~
    * When this option is chosen, you should calculate the maximum number of times the alphabet could be repeated on the size board that is selected and set the walk length to that value.
    *Make this field "sticky"

* ~By default, have the "grid size" drop down preselected to 25~
    * ~Make this field "sticky"~

* ~Make the "random seed" text input "sticky"~
    * ~That means it should display the most recently produced/selected seed so it can be used again if desired~
    * ~When the page is first loaded, make this field empty~
    * ~Remove the "seed=xxxxxxxx" that used to be displayed above the grid. It is now part of the text input field~

* ~Since "Submit" will always use the displayed value of the seed field unless you change it, add a "Clear and Submit" button~
    * ~This button will clear the "random seed" field using JavaScript before it submits the form so we get a new random seed~

* ~Add an "In Color" checkbox that, when selected, will colorize the output~
    * ~This option should choose random rgb values for each run of the alphabet~
    * ~This option should be selected by default, but also be "sticky"~
    * Every time you hit "submit," the random pattern should stay the same, but the random colors should change
        * This one is a bit tricky since there can be only one random number generator per php process
        * HINT: the number generator can be seeded after it has been already been used to generate a series of random values
    * ~When this option is unchecked, all letters should be black~
* ~Grid dots are always light gray~
* Video outline of this assignment: https://www.youtube.com/watch?v=odviMFtawW0&ab_channel=StefenHoward
<br>

### Approaches by Howard
* Have array that stores information sbout the styling for each cell
* Store the string specifying the td, style, and content in the grid rather than just the character alone
<br>

# Working with GitHub
### How we should work using GitHub:
I believe using GitHub will help and allow us to use it as a tool now and in the future. <br>
Therefore, I think we should learn how to use branches.
First: I would learn about github branches using this [video](https://www.youtube.com/clip/Ugkxxgn68sIypKs7OcqaAXbsZbi_JItcGrhf) or [this one](https://youtu.be/JTE2Fn_sCZs?t=72), they both help explain branches and how to use them
<br>
Then,
   * 1.) Dowload this project **locally** on your computer through your local terminal or [GitHub Desktop software](https://desktop.github.com/)
   * 2.) Go to the directory, via terminal or GitHub Desktop, where your downloaded project is found and create a new branch to work in:
      * git branch nameOfBranch
      * (replace nameOfBranch with the name of the feature you plan on adding)
   * 3.) Switch to that working branch
      * git checkout nameOfBranch
   * 4.) Open your text editor or terminal to work on your feature and finish it
   * 5.) When you are finished with a feature:
      * git add -A
      * git commit -m "type short message regarding the feature you are implementing"
      * git push
   * 6.) Wait for a group member to review the code and officially implement your code via GitHub
   * 7.) Once your code is implemented, you should recieve a notification and then:
      * delete the branch on your local computer with: git branch -d nameOfBranch
      * then update your main branch with: 
         * git checkout main  
         * git pull
      * repeat steps 2-7
<br> 
I also recommend running 'git pull' each time you get on your terminal to work to ensure you have the latest updates on the files.
<br>

If this method of working doesn't work or seems too much. Let me know and we'll find alternatives. -Jon
