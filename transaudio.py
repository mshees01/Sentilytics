import whisper

model = whisper.load_model("base")  # or "small", "medium", "large"
result = model.transcribe("newsaudio.m4a")

transcript = result["text"]
print("Transcript:", transcript)
