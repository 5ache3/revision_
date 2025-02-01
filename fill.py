from playwright.sync_api import sync_playwright
import time

# yak t3amel 4e code la bdalak mn playwright 
# dir vi terminal :
# pip install playwright

registration_link='http://localhost/revision/register.php' # the link to your page
start=1 # start from user1 with email1@gmail.com with password1
add=10 # add 10 users at atime

for i in range(start,start+add):
    print(i)
    username=f'user{i}'
    email=f'email{i}@gmail.com'
    password=f"password{i}"
    try :
        with sync_playwright() as p:
            browser=p.chromium.launch(headless=False)
            page=browser.new_page()
            page.goto(registration_link) 
            page.fill('input#username',f'{username}\n')
            time.sleep(.5)
            page.fill('input#email',f'{email}\n')
            time.sleep(.5)
            page.fill('input#password',f'{password}\n')
            time.sleep(.5)
            page.fill('input#confirmPassword',f'{password}\n')
            time.sleep(.5)
            button = page.query_selector('button#send')
            button.press('Enter')
            time.sleep(.5)
    except Exception as e :
        print(e)