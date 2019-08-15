@ECHO OFF
SETLOCAL
FOR %%i IN (%CD%\*) DO if "%%~xi" EQU ".md" pandoc %%~nxi -o %%~ni.html
REM @ECHO %%i