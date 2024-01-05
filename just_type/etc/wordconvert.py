with open('wordlist.txt', 'r', encoding='utf-8') as file:
    # Read the entire file as a single string
    text = file.read()

# Split the text into poems by '/' character
poems = text.split('/')

# For each poem, split into lines, then split each line into words
# Filter out any empty lines or words
poems_words = [[word for line in poem.splitlines() for word in line.split() if line and word] for poem in poems]

# Print each poem on a new line
print("let poems = [")
for poem_words in poems_words:
    print(poem_words)
    print(",")
    print("\n")  # New line character after every poem
print("]")
print(";")
