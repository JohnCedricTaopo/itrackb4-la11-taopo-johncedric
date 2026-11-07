## Lab Activity 11 Answers

### G1. What two things are needed for route model binding?

The controller parameter must be type-hinted with the `Character` model, and the variable name must match the route segment name. For the `characters` resource, Laravel uses `{character}`, so the method must use `Character $character`. If either the type or name is wrong, Laravel will not inject the record correctly.

### G2. Why did the Delete link open the detail page?

An HTML link sends a GET request only. The GET request for the same character address belongs to the show action, while deleting requires the DELETE verb. Therefore, the link opened the detail page instead of deleting anything.

### G3. What would break if the second argument of old() were missing or used alone?

Without the second argument, a fresh edit form would be empty because there would be no current character value to use as a fallback. If I used only the record value and left out old(), the form would lose the values I typed after a rejected submission. Using both lets Laravel show old input first and the saved record value otherwise.