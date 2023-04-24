from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import re



PATH = "C:\Program Files (x86\chromedriver.exe)"

driver = webdriver.Chrome(PATH)

driver.get("https://www.nfl.com/injuries/")

select_year = Select(WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.CLASS_NAME, 'd3-o-dropdown'))))

week_x_path = "//*[@id='main-content']/section[1]/div/div[2]/div[2]/div/div/div[2]/select"

select_week = Select(WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, week_x_path))))


#index 0 is 2023, no info on it yet
years_before_2023=[1,2,3,4]

#select.select_by_index(2)

select_week.select_by_index(3)


date_path = "//*[@id='main-content']/section[3]/div/div/div/h2[1]"

table_to_be = "//*[@id='main-content']/section[3]/div/div/div/section["


def find_number_of_tables():
    elements =  len(driver.find_elements(By.CLASS_NAME, 'nfl-o-injury-report__unit'))
    return elements

def find_number_of_players_first(i):
    elements = len(driver.find_elements(By.XPATH, table_to_be + str(i) + "]/div[3]/table/tbody/tr"))
    return elements

def find_number_of_players_second(i):
    elements = len(driver.find_elements(By.XPATH, table_to_be + str(i) + "]/div[5]/table/tbody/tr"))
    return elements

number_of_tables = find_number_of_tables()

headers = ['Player', 'Position', 'Injuries', 'Practice Status', 'Game Status']

for i in range(1, number_of_tables):
    first_team_players =  find_number_of_players_first(i)
    first_team = []
    for k in range(1, first_team_players):
        name = table_to_be + str(i) + "]/div[3]/table/tbody/tr[" + str(k) + "]/td[1]/a"
        player_name = driver.find_element(By.XPATH, name).text
        first_team.append(player_name)
        position = table_to_be + str(i) + "]/div[3]/table/tbody/tr[" + str(k) + "]/td[2]"
        position_name = driver.find_element(By.XPATH, position).text
        first_team.append(position_name)
        injury = table_to_be + str(i) + "]/div[3]/table/tbody/tr[" + str(k) + "]/td[3]"
        injury_name = driver.find_element(By.XPATH, injury).text
        if not injury_name:
            injury_name = 'null'
        first_team.append(injury_name)
        practice = table_to_be + str(i) + "]/div[3]/table/tbody/tr[" + str(k) + "]/td[4]"
        prac_status = driver.find_element(By.XPATH, practice).text
        first_team.append(prac_status)
        game = table_to_be + str(i) + "]/div[3]/table/tbody/tr[" + str(k) + "]/td[5]"
        game_status = driver.find_element(By.XPATH, game).text
        if not game_status:
            game_status = 'null'
        first_team.append(game_status)
    print(first_team)
        

driver.quit()

