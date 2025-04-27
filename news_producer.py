import requests
import time
import subprocess

NEWS_API_KEY = 'b7f262aaa2aa474381e86133f4879a44'
FLUVIO_TOPIC = 'news-stream'
NEWS_API_URL = f'https://newsapi.org/v2/top-headlines?country=in&apiKey={NEWS_API_KEY}'

def fetch_news():
    response = requests.get(NEWS_API_URL)
    if response.status_code == 200:
        articles = response.json().get('articles', [])
        headlines = [a['title'] for a in articles if a['title']]
        return headlines
    else:
        print("Error fetching news:", response.status_code)
        return []

def push_to_fluvio(headlines):
    for headline in headlines:
        try:
            subprocess.run(
                ['fluvio', 'produce', FLUVIO_TOPIC],
                input=headline.encode(),
                check=True
            )
            print("Pushed:", headline)
        except Exception as e:
            print("Fluvio push error:", e)

while True:
    headlines = fetch_news()
    push_to_fluvio(headlines)
    time.sleep(30)  # Wait for 30 seconds
