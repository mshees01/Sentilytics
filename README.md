Sentilytics
News Sentiment Analysis Dashboard

Real-Time News Sentiment Dashboard with Fluvio & Groq
Overview
This project implements a real-time news sentiment dashboard that leverages Groq for multimodal sentiment analysis (text + audio) and Fluvio for streaming breaking news data. The system fetches live news articles, analyzes their sentiment (positive, negative, or neutral), and provides real-time updates as the sentiment evolves. It is designed to process both text and audio data, making it a powerful tool for analyzing news content from multiple perspectives.

Features
Real-time News Streaming: Uses Fluvio to stream live breaking news articles.
Multimodal Sentiment Analysis: Analyzes both text and audio content of news using Groq.
Responsive User Interface: The dashboard dynamically updates the news and sentiment analysis with a clean and modern user interface.
Visual Sentiment Indicators: Displays sentiment as color-coded labels (green for positive, red for negative, and yellow for neutral).
Multimedia Integration: Processes news articles with both textual and audio components to deliver a more comprehensive sentiment analysis.
Technologies Used
Frontend: HTML, CSS, JavaScript, TailwindCSS
Backend: Flask (Python)
Sentiment Analysis: Groq (for multimodal analysis of text and audio)
News Streaming: Fluvio (for real-time news data streaming)
Real-time Updates: JavaScript and Fetch API for periodic updates
Project Architecture
The project is divided into three main parts:

Frontend: Displays the sentiment dashboard and updates the content dynamically based on real-time data.
Backend: Flask server fetches news data, performs sentiment analysis using Groq, and serves the results via a RESTful API.
Streaming & Analysis: Fluvio is used for real-time news streaming, while Groq processes both text and audio components for sentiment analysis.
Setup & Installation
Prerequisites
Ensure you have the following installed:

Python 3.x
Flask (Backend)
Fluvio (for news streaming)
Groq (for sentiment analysis)
