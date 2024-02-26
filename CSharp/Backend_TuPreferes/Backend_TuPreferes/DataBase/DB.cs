using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
/*
 * Auteur : Yoann Meier, Alexandre Babich
 * Projet : Administration du jeu web Tu Prefere
 * Description : Page d'interaction avec la base de donnée
 */
namespace Backend_TuPreferes.DataBase
{
    public class DB
    {
        private MySqlConnectionStringBuilder builder;
        private MySqlConnection connection;

        public DB(string server, string username, string password, string dbName, uint port)
        {
            // Connexion à la base de donnée
            builder = new MySqlConnectionStringBuilder();

            builder.Server = server;
            builder.UserID = username;
            builder.Password = password;
            builder.Database = dbName;
            builder.Port = port;

            connection = new MySqlConnection(builder.ConnectionString);
        }

        /// <summary>
        /// Exécute un query avec des paramètres optionnels
        /// </summary>
        /// <param name="sql">Le sql éxécuter</param>
        /// <param name="param">les parmètres possibles</param>
        /// <returns>Retourne les valeurs retournées par la base de donnée</returns>
        public List<string[]> dbRun(string sql, MySqlParameter[] param = null)
        {
            try
            {
                connection.Open();

                using (MySqlCommand command = new MySqlCommand(sql, connection))
                {
                    if (param != null)
                    {
                        command.Parameters.AddRange(param);
                    }

                    using (MySqlDataReader reader = command.ExecuteReader())
                    {
                        List<string[]> result = new List<string[]>();

                        while (reader.Read())
                        {
                            string[] values = new string[reader.FieldCount];
                            for (int i = 0; i < reader.FieldCount; i++)
                            {
                                values[i] = reader[i].ToString();
                            }
                            result.Add(values);
                        }

                        return result;
                    }
                }
            }
            catch (MySqlException e)
            {
                MessageBox.Show(e.ToString());
                return null;
            }
            finally
            {
                if (connection != null && connection.State == ConnectionState.Open)
                {
                    connection.Close();
                }
            }
        }
    }
}
