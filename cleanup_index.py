
with open('resources/views/index.blade.php', 'r', encoding='utf-8') as f:
    lines = f.readlines()

# 0-indexed in python, so line 287 is index 286.
# We want to keep lines 0 to 286 (inclusive).
# Lines are 1-based in my analysis.
# Keep 1-287 -> lines[0:287]
# Skip 288-4796 -> lines[287:4796]
# Keep 4797-end -> lines[4796:]

# Let's verify content at boundaries
print(f"Line 287 (index 286): {lines[286]}")
print(f"Line 288 (index 287): {lines[287]}")
print(f"Line 4796 (index 4795): {lines[4795]}")
print(f"Line 4797 (index 4796): {lines[4796]}")

new_content = lines[:287] + lines[4796:]

with open('resources/views/index.blade.php', 'w', encoding='utf-8') as f:
    f.writelines(new_content)
