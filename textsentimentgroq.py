import requests

GROQ_API_KEY = "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"
TEXT_FILE = "recent_news_april_2025.txt"

def get_sentiment(text):
    headers = {
        "Authorization": f"Bearer {GROQ_API_KEY}",
        "Content-Type": "application/json"
    }

    payload = {
        "model": "llama-3.1-8b-instant",  # Change to Llama 3.1 8B
        "messages": [
            {
                "role": "system",
                "content": "You are a sentiment analysis model. Return only one of: 'Positive', 'Negative', or 'Neutral'."
            },
            {
                "role": "user",
                "content": text
            }
        ]
    }

    response = requests.post("https://api.groq.com/openai/v1/chat/completions", headers=headers, json=payload)

    if response.status_code == 200:
        return response.json()["choices"][0]["message"]["content"].strip()
    else:
        return "Error"


# Read file and process
with open(TEXT_FILE, "r") as f:
    for line in f:
        text = line.strip()
        if text:
            sentiment = get_sentiment(text)
            print(f"[News] {text}\n[Sentiment] {sentiment}\n")
