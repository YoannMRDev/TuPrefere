using Backend_TuPreferes.DataBase;
using MySqlX.XDevAPI.Common;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Backend_TuPreferes
{
    public partial class frmAjouterDilemme : Form
    {
        List<string[]> categories;
        public frmAjouterDilemme(FunctionDB functionDB)
        {
            InitializeComponent();
            categories = functionDB.GetAllCategorie();
            foreach (string[] row in categories)
            {
                cmbCategorie.Items.Add(row[1]);
            }

            cmbCategorie.SelectedItem = cmbCategorie.Items[0];
        }

        /// <summary>
        /// Retourne le premier choix
        /// </summary>
        public string GetChoix1()
        {
            return tbxChoix1.Text;
        }

        /// <summary>
        /// Retourne le deuxième choix
        /// </summary>
        public string GetChoix2()
        {
            return tbxChoix2.Text;
        }

        /// <summary>
        /// Retourne la catégorie
        /// </summary>
        public string GetCategorie()
        {
            return cmbCategorie.Text;
        }

        public void EnabledButtonAdd(object sender, EventArgs e)
        {
            btnAjouter.Enabled = tbxChoix1.Text != "" && tbxChoix2.Text != "" && cmbCategorie.Text != "";
        }
    }
}
