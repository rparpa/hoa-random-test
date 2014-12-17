%skip   space     \s

%token kid "id"


// Generated grammar
// Types.
%token  test      "[a-Z]+"

// Delimiters.
// Strings.
%token  quote_         "        -> string
%token  string:string  [^"\\]+
%token  string:_quote  "        -> default

// Objects.
%token  brace_         {
%token _brace          }

// Arrays.
%token  bracket_       \[
%token _bracket        \]

// Json.
%token  colon          :
%token  comma          ,

value:
    list()

#list:
    ::bracket_::
        <test>
    ::_bracket::