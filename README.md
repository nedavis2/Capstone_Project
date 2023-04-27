# Silicon Stadium

We're "Hello World or Bust" and we are developing a web application to enhance the enjoyment of NFL and fantasy football with friends, family, and foes. Our app will enable people to better predict the outcome of fantasy football before the real NFL games are played. Some people are intimidated by fantasy football and this tool will give the entry level player a way to feel more comfortable discussing their teams at the water cooler or family function. The fantasy sports sector has been growing with no signs of slowing down as fantasy sports have the potential to increase engagement in sporting events, sports news, and online content. Fantasy football (NFL) is the most popular with 20% of US adults over the age of 21 having played in the last 12 months. This number is up from just 10% in 2010. An industry that cannot be ignored.

Our goal of this app is to streamline the statistical analysis behind fantasy football. To give our users the knowledge to make more informed decisions on who to start or sit in their lineup each week. Our application will use machine learning to predict a players stat line and we hope to have a neural network that is correct 70% of the time or better which is top of the line in this industry. 
As everyone knows the NFL is a fast moving dangerous sport and injuries are bound to happen. So our application will focus on predicting injury rate.  The idea behind this metric will be to keep track of injury data in regard to players individually and in a separate metric we will look at the overall injury patterns of entire teams. For players we will look at how often a player is injured, how severe the injury, and how many games they miss because of it which we can then use to factor in with our predictions about their performance. With the team wide injury analysis, we can look at how often people are injured while playing for the team, how severe the injury, and how much time they miss. The look at teamwide trends is not something widely tracked and may yield interesting insight into whether some teams are just better at protecting from injuries than others.  

We also will be implementing an API request for Database operation. The goal here will be to do an initial pull to fill our databases with all the historic data we deem necessary. After this we can update our database with scheduled pulls from the API, at an interval we find most efficient, without having to worry about usage constraints imposed by the free API's we have chosen. The databases that we populate will operate in similar fashion to a repository, we will have the master databases which will not be operated upon except for pulls to add more current data. The data being analyzed will come from branched off databases to not compromise our master database and require unnecessary API pulls to restore it.  To separate our application from competitors we are also going to be using a weather API for up to date weather data and forecasts to give our customers the upper hand in their leagues. 

Our web application will be free to use, selling advertising space to interested advertisers. Our customers will have the ability to sign up for a monthly membership that hides these advertisements and gives them other benefits like alerts for drastic weather conditions change.

First time run Requirements:
1. Turn on Xampp and start Apache and mySQL
2. Import table_creations.sql, located /Database, into database
3. Run table_splitter.py, located /Data
4. Run insert.php, located /Database
5. Run pip_install.py, located /src, if on new system.
6. Contact winters1291@gmail to get email added to google authorization.
7. Add email into database 'users' table.
8. Using prefered browser, navigate to localhost/Capstone_project/src/button.html.
9. Login and explore.




